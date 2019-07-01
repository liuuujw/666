<?php

namespace backend\controllers;

use yii;
use backend\models\Xyft;
use backend\models\XyftForm;

class XyftController extends yii\web\Controller
{

    public $layout = 'main';

    public function actionIndex()
    {
        header("Content-type:text/html; charset=utf-8");
        $res = $this::getKjRes();
        $count = count($res);
        $oneArray = [];
        $stageCount = 0;
        for ($i = 0; $i < $count; $i++) {
            if (!isset($res[$i]['one'])) {
                echo $i;
                continue;
            }
            $one = $res[$i]['one'];
            $guess = implode(',', $this->getFiveRandNumber());
            $stageCount++;
            $oneArray[] = $one;
            echo '第' . substr($res[$i]['stage'], 8) . '期开奖：' . $one;
            echo '<br>';
            echo '前' . $stageCount . '期:&nbsp;&nbsp;&nbsp;&nbsp;';
            $chanceArray = array_count_values($oneArray);
            arsort($chanceArray);
            foreach ($chanceArray as $k => $v) {
                $str = $k . ':' . number_format($v / $stageCount, 2) * 100 . '%;&nbsp;&nbsp;';
                if ($res[$i]['one'] == $k) {
                    echo '<span style="color:#ff003c">' . $str . '</span>';
                } else {
                    echo $str;
                }
            }
            echo '<br>';
        }
        die;
    }

    public function actionAdd()
    {
        $this->layout = 'main';
        $model = new XyftForm();
        $msg = '';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $res = $model->addInfo();
            if ($res) {
                Yii::$app->session->setFlash('success', '��ӳɹ�');
                return $this->redirect('/xyft/add');
            } else {
                Yii::$app->session->setFlash('error', '���ʧ��');
            }
        }

        return $this->render('add', ['model' => $model]);
    }

    private function getFiveRandNumber()
    {
        $number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $return = [];
        $count = 9;
        for ($i = 0; $i < 5; $i++) {
            $key = rand(0, ($count - $i));
            $return[] = $number[$key];
            $number = $this->arrayRemove($number, $key);
        }
        sort($return);
        return $return;
    }

    private function arrayRemove(array $array, $key)
    {
        if (!is_array($array)) {
            return $array;
        }
        $newArray = [];
        unset($array[$key]);
        foreach ($array as $value) {
            $newArray[] = $value;
        }
        return $newArray;
    }

    public function actionFind()
    {
        $string = file_get_contents('./kj.txt');
        $result = json_decode($string, JSON_UNESCAPED_UNICODE);
        $result = $result['Data'];
        $_model = new Xyft();

        foreach ($result as $key => $value) {
            $model = clone $_model;
            if (!$model::find()->where(['stage' => $value['number']])->one()) {
                $model->isNewRecord = true;
                $model->stage = $value['number'];
                $valArr = explode(',', $value['openCode']);
                $model->one = $valArr[0];
                $model->two = $valArr[1];
                $model->three = $valArr[2];
                $model->four = $valArr[3];
                $model->five = $valArr[4];
                $model->six = $valArr[5];
                $model->seven = $valArr[6];
                $model->eight = $valArr[7];
                $model->nine = $valArr[8];
                $model->ten = $valArr[9];
                $model->kjtime = $value['date'];
                $model->kjdate = substr($value['number'], 0, 4) . '-' . substr($value['number'], 4, 2) . '-' . substr($value['number'], 6, 2);
                $model->save() && $model->id = 0;
            }
        }
    }

    public function actionGetres()
    {
        $string = file_get_contents('https://www.568kj1.com/ft/xyft.php');
        $preg = '/<span.*>(.*)<\/span>/isU';
        $numberPreg = '/<h2.*>(.*([0-9]{11}).*)<\/h2>/isU';
        preg_match_all($numberPreg, $string, $numberRes);
        preg_match_all($preg, $string, $res);
        $number = $numberRes[2][0];
        $model = new Xyft();
        if (!$model::find()->where(['stage' => $number])->one()) {
            $model->stage = $number;
            $model->one = $res[1][0];
            $model->two = $res[1][1];
            $model->three = $res[1][2];
            $model->four = $res[1][3];
            $model->five = $res[1][4];
            $model->six = $res[1][5];
            $model->seven = $res[1][6];
            $model->eight = $res[1][7];
            $model->nine = $res[1][8];
            $model->ten = $res[1][9];
            $model->kjtime = date('Y-m-d H:i:s');
            $model->kjdate = substr($number, 0, 4) . '-' . substr($number, 4, 2) . '-' . substr($number, 6, 2);
            return $model->save();
        }

        return false;
    }

    //获取各类型kj信息
    function getInfo($res, $type, $date)
    {
        if (!is_array($res) || empty($res)) {
            return false;
        }
        $info = '';
        //第一期3号的名次
        $ranking = $this->findRanking($res[0], $type);
        //kj总期数
        $stageCount = count($res);
        //相隔期数
        $partition = 0;

        $info = '期数：' . 1 . ',第' . $this->transformNumber($ranking) . '名<br>';
        for ($i = 1; $i < $stageCount; $i++) {

            if (!isset($res[$i][$ranking])) {
                echo $i;
                die;
            }
            $rule = $this->getRuleResult($res[$i][$ranking], $type);
            //下一次3号上面的号码
            if ($rule) {
                //单数
                $info .= '期数：' . ($i + 1) . '___中, 相隔' . $partition . '期,第' . $this->transformNumber($ranking) . '名<br>';
                $partition = 0;
                $ranking = $this->findRanking($res[$i], $type);
            } else {
                //双数
                $partition += 1;
            }

        }
        return $info;
    }

    //获取名次
    function findRanking($data, $type = 3)
    {
        foreach ($data as $k => $v) {
            if ($v == $type) {
                return $k;
            }
        }
    }

    //获取规则是否成立
    function getRuleResult($number, $type)
    {
        switch ($type) {
            case 2:
                $res = ($number < 6) ? true : false;
                return $res;
                break;
            case 3:
            case 7:
                $res = ($number % 2 == 1) ? true : false;
                return $res;
                break;
            case 10:
                $res = ($number % 2 == 0) ? true : false;
                return $res;
                break;
        }
    }

    //名次英文转数字
    function transformNumber($enNumber)
    {
        switch ($enNumber) {
            case 'one':
                return 1;
                break;
            case 'two':
                return 2;
                break;
            case 'three':
                return 3;
                break;
            case 'four':
                return 4;
                break;
            case 'five':
                return 5;
                break;
            case 'six':
                return 6;
                break;
            case 'seven':
                return 7;
                break;
            case 'eight':
                return 8;
                break;
            case 'nine':
                return 9;
                break;
            case 'ten':
                return 10;
                break;
        }
    }

    //获取开奖结果
    private function getKjRes($date = '')
    {
        if ($date == '') {
            $date = (date('H') < 13) ? date('Y-m-d', strtotime('-1 days')) : date('Y-m-d');
        }
        $res = Xyft::find()
            ->Where(['kjdate' => $date])
            ->asArray()
            ->orderBy(['stage' => SORT_ASC])
            ->all();
        return $res;
    }

    //概率显示
    public function actionChance()
    {

        $date = date('H') < 13 ? date('Y-m-d', strtotime('-1 days')) : date("Y-m-d");
        $date = Yii::$app->request->get('date') ? Yii::$app->request->get('date') : $date;
        $res = $this->getKjRes($date);
        $two = $this->getInfo($res, 2, $date);
        $three = $this->getInfo($res, 3, $date);
        $seven = $this->getInfo($res, 7, $date);
        $ten = $this->getInfo($res, 10, $date);

        //冠军1-6号
        $oneLessThanSix = $this->LessThanSix($res);
        //冠军为上一期的1-6名
        $championOneToSix = $this->oneToSix($res);
        //7-10 名买上期的7-10名
        $sevenToTen = $this->sevenToTen($res);
        return $this->render('chance', [
            'date' => $date,
            'two' => $two,
            'three' => $three,
            'seven' => $seven,
            'ten' => $ten,
            'oneLessThanSix' => $oneLessThanSix,
            'championOneToSix' => $championOneToSix,
            'sevenToTen' => $sevenToTen,
        ]);
    }

    function LessThanSix($res)
    {
        if (empty($res)) {
            return false;
        }
        $resString = '';
        $partition = 0;
        foreach ($res as $key => $val) {
            if ($val['one'] < 7) {
                $resString .= '第' . ($key + 1) . '期：' . $val['one'] . '  相隔:' . $partition . '期 <br />';
                $partition = 0;
            } else {
                $partition += 1;
            }
        }
        return $resString;
    }

    function oneToSix($res)
    {
        $string = '';
        $partition = 0;
        $stageCount = count($res);
        $prevSixNumber = $this->getSixNumberInArray($res[0]);
        $string .= '第1期：' . $res[0]['one'] . '<br>';
        for ($i = 1; $i < $stageCount; $i++) {
            if (in_array($res[$i]['one'], $prevSixNumber)) {
                $prevSixNumberString = implode(',', $prevSixNumber);
                $string .= '第' . ($i + 1) . '期：' . $res[$i]['one'] . '  相隔:' . $partition . '期,上期开奖号码：' . $prevSixNumberString . ' <br />';
                $prevSixNumber = $this->getSixNumberInArray($res[$i]);
                $partition = 0;
            } else {
                $partition += 1;
            }
        }
        return $string;
    }

    function getSixNumberInArray($data)
    {
        if (is_array($data) && !empty($data)) {
            $sixNumberArr = [];
            $sixNumberArr[] = $data['one'];
            $sixNumberArr[] = $data['two'];
            $sixNumberArr[] = $data['three'];
            $sixNumberArr[] = $data['four'];
            $sixNumberArr[] = $data['five'];
            $sixNumberArr[] = $data['six'];

            return $sixNumberArr;
        }
        return false;
    }

    public function actionSeven()
    {

        $res = $this->getKjRes();
        $base = 1;
        $totalProfit = 0;
        $resourceStage = 1;
        $stageCount = count($res);
        $residueKeys = [];
        $prevSevenToTenRes = $this->getSevenToTenNumber($res[0],$residueKeys);
        $returnString = '第1期7-10名：' . implode(',', $prevSevenToTenRes) . '<br>';
        for ($i = 1; $i < $stageCount; $i++) {
            $currentRes = $this->getSevenToTenNumber($res[$i],$residueKeys);
            foreach ($currentRes as $key => $val) {
                if (in_array($val, $prevSevenToTenRes)) {
                    $residueKeys[] = $key;
                    if(count($residueKeys) == 4){
                        $residueKeys = [];

                    }
                }
            }

        }
        return $returnString;
    }

    function getSevenToTenNumber($data, $keys = [])
    {
        if (is_array($data) && !empty($data)) {

            $sevenToTenNumberArr = [];
            $sevenToTenNumberArr['seven'] = isset($data['seven']) && $data['seven'] ? $data['seven'] : '';
            $sevenToTenNumberArr['eight'] = isset($data['eight']) && $data['eight'] ? $data['eight'] : '';
            $sevenToTenNumberArr['nine'] = isset($data['nine']) && $data['nine'] ? $data['nine'] : '';
            $sevenToTenNumberArr['ten'] = isset($data['ten']) && $data['ten'] ? $data['ten'] : '';
            if (!empty($keys)) {
                foreach ($keys as $val) {
                    unset($sevenToTenNumberArr[$val]);
                }
            }
            return $sevenToTenNumberArr;
        }
        return false;
    }

}