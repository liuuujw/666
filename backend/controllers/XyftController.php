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
        $date = date('H') < 13 ? date('Y-m-d', strtotime('-1 days')) : date("Y-m-d");
        $rank = Yii::$app->request->get('rank') ? Yii::$app->request->get('rank') : 'one';
        $date = Yii::$app->request->get('date') ? Yii::$app->request->get('date') : $date;
        $res = $this::getKjRes($date);
        $count = count($res);
        $oneArray = [];
        $returnRes = [];
        $stageCount = 0;

        $hotNumberCount = 0;        //热门号码总数
        $coolNumberCount = 0;       //冷门号码总数
        $tenNumberStage = '';       //开出10个号码期数
        $prevTenNumberChance = [];

        //冷热号码期数
        $hotStage = [];
        $coolStage = [];

        $hotLian = 0;
        $coolLian = 0;

        $maxHotLian = 0;
        $maxCoolLian = 0;

        $isBegin = false;
        for ($i = 0; $i < $count; $i++) {
            $result = [];
            $stageCount++;
            $oneArray[] = $res[$i][$rank];

            $result['stageCount'] = $stageCount;    //总期数
            $result['stage'] = substr($res[$i]['stage'], 8);  //期数
            $result['kjRes'] = $res[$i][$rank];   //开奖结果

            //统计每个号码的个数
            $chanceArray = array_count_values($oneArray);
            arsort($chanceArray);
            if (count($chanceArray) >= 5) {
                //出齐5个号码，统计冷热数量
                $tenNumberStage = ($tenNumberStage == '') ? $result['stage'] : $tenNumberStage;
                if (count($prevTenNumberChance) != 0) {
                    $keyArr = array_keys($prevTenNumberChance);
                    $numberRank = array_keys($keyArr, $result['kjRes']);
                    if (isset($numberRank[0]) && $numberRank[0] < 5 && $isBegin == true) {
                        //热门号码
                        $hotNumberCount += 1;
                        $hotStage[] = $result['stage'];
                        $hotLian += 1;
                        $maxHotLian = $hotLian > $maxHotLian ? $hotLian : $maxHotLian;
                        $coolLian = 0;
                    } else {
                        //冷门号码
                        $coolNumberCount += 1;
                        $coolStage[] = $result['stage'];
                        $coolLian += 1;
                        $maxCoolLian = $coolLian > $maxCoolLian ? $coolLian : $maxCoolLian;
                        $hotLian = 0;
                    }
                    $isBegin = true;
                }
                $prevTenNumberChance = $chanceArray;
            }
            $result['chance'] = $chanceArray;
            $returnRes[] = $result;
        }
        return $this->render('index', [
            'hotNumberCount' => $hotNumberCount,
            'coolNumberCount' => $coolNumberCount,
            'tenNumberStage' => $tenNumberStage,
            'hotStage' => $hotStage,
            'coolStage' => $coolStage,
            'maxHotLian' => $maxHotLian,
            'maxCoolLian' => $maxCoolLian,
            'data' => $returnRes,
            'rank' => $rank,
            'date' => $date,
        ]);

    }


    public function actionOverview()
    {
        header("Content-type:text/html; charset=utf-8");
        $date = Yii::$app->request->get('date') ? Yii::$app->request->get('date') : '';
        $res = $this::getKjRes($date);
        $count = count($res);
        $oneArray = [];
        $returnRes = [];
        $stageCount = 0;
        $rank = [];
        $rankDesc = Yii::$app->params['xyftRank'] ? Yii::$app->params['xyftRank'] : '';
        foreach ($rankDesc as $k => $v) {
            $rank[] = $k;
        }
        for ($i = 0; $i < $count; $i++) {

            $stageCount++;
            foreach ($rank as $r) {
                $result = [];
                $oneArray[$r][] = $res[$i][$r];
                $chanceArray = array_count_values($oneArray[$r]);
                arsort($chanceArray);
                $result['chance'] = $chanceArray;
                $result['stageCount'] = $stageCount;    //总期数
                $result['stage'] = substr($res[$i]['stage'], 8);  //期数
                $result['kjRes'] = $res[$i][$r];   //开奖结果
                if ($i == ($count - 1)) {
                    $result['rankDesc'] = '第' . $this->transFromNumber($r) . '名';
                    $returnRes[$r] = $result;
                }
            }
        }
        return $this->render('overview', [
            'data' => $returnRes,
            'rank' => 'all',
        ]);
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

        /*
         * @param $baseMoney  下注初始金额
         * @param $double 翻倍数
         * @param $totalPayMoney 下注总金额
         * @param $totalWinMoney 中奖总金额
         * @param $maxPayMoney 最大下注金额
         */
        $baseMoney = 20;
        $double = 1;
        $totalPayMoney = 0;
        $totalWinMoney = 0;
        $maxPayMoney = 0;

        $info = '期数：' . 1 . ',第' . $this->transFromNumber($ranking) . '名<br>';
        for ($i = 1; $i < $stageCount; $i++) {

            if (!isset($res[$i][$ranking])) {
                echo $i;
                die;
            }

            //下注金额, 下注总金额,最大下注金额
            $payMoney = $baseMoney * $double;
            $totalPayMoney += $payMoney;
            $maxPayMoney = ($payMoney > $maxPayMoney) ? $payMoney : $maxPayMoney;

            $rule = $this->getRuleResult($res[$i][$ranking], $type);
            //下一次3号上面的号码
            if ($rule) {

                //中奖、中奖总额、盈利,
                $winMoney = $payMoney * 197 / 100;
                $totalWinMoney += $winMoney;
                $profit = $winMoney - $payMoney;

                //单数
                $info .= '期数：' . ($i + 1) . '中, 相隔' . $partition . '期,第' . $this->transFromNumber($ranking) . '名';
//                $info .= PHP_EOL;
//                $info .= '下注：￥' . $payMoney . ',中奖：￥' . $winMoney . ',盈利：￥' . $profit;
                $info .= '<br>';
                $partition = 0;
                $double = 1;
                $ranking = $this->findRanking($res[$i], $type);
            } else {
                //双数
                $partition += 1;
                $double *= 2;
            }

        }
//        $info .= PHP_EOL . "下注初始金额：￥ $baseMoney ，最大下注金额：￥{$maxPayMoney}，下注总额：￥ $totalPayMoney ，中奖总额：￥ $totalWinMoney";
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
    function transFromNumber($enNumber)
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

        return $this->render('chance', [
            'date' => $date,
            'two' => $two,
            'three' => $three,
            'seven' => $seven,
            'ten' => $ten,
            'oneLessThanSix' => $oneLessThanSix,
            'championOneToSix' => $championOneToSix,
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
        $base = 0;
        $payMoney = 0;
        $baseMoney = 50;
        $totalProfit = 0;
        $string .= '第1期：' . $res[0]['one'] . '<br>';
        for ($i = 1; $i < $stageCount; $i++) {
            if (in_array($res[$i]['one'], $prevSixNumber)) {
//                $payMoney += $baseMoney * ($base + 1) * 6;
//                $winMoney = $baseMoney * ($base + 1) * 97 / 10;
//                $profit = $winMoney - $payMoney;
//                $totalProfit += $profit;
                $prevSixNumberString = implode(',', $prevSixNumber);
                $string .= '第' . ($i + 1) . '期：' . $res[$i]['one'] . '  相隔:' . $partition . '期,上期开奖号码：' . $prevSixNumberString;
                /*$string .= '，下注总额：￥' . $payMoney;
                $string .= '，中奖金额：￥' . $winMoney;
                $string .= '，盈利：￥' . $profit;*/
                $string .= ' <br />';
                $prevSixNumber = $this->getSixNumberInArray($res[$i]);
                $partition = 0;
                $base = 0;
                $payMoney = 0;
            } else {
                if ($i == 179) {
                    $totalProfit -= ($baseMoney * $base * 6);
                }
                $payMoney += $baseMoney * ($base + 1) * 6;
                $partition += 1;
                $base += 1;

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
//            $sixNumberArr[] = $data['six'];

            return $sixNumberArr;
        }
        return false;
    }

    function sevenToTen($res)
    {

        $resourceStage = 1; //参考期数
        $stageCount = count($res);
        $prevSevenToTenRes = $this->getSevenToTenNumber($res[0]);
        $returnString = '第1期7-10名：' . implode(',', $prevSevenToTenRes) . '<br>';
        for ($i = 1; $i < $stageCount; $i++) {
            $winNumber = 0;
            $winNumberString = '';
            $resourceStageResString = implode(',', $prevSevenToTenRes);
            $currentStageRes = $this->getSevenToTenNumber($res[$i]);
            foreach ($currentStageRes as $key => $val) {
                if (in_array($val, $prevSevenToTenRes)) {
                    $prevSevenToTenRes = $this->unsetResByValue($prevSevenToTenRes, $val);
                    $winNumber += 1;
                    $winNumberString .= ',' . $this->transFromNumber($key) . '=>' . $val;
                }
            }
            //拼接显示字符串
            $returnString .= '第' . ($i + 1) . '期:' . implode(',', $currentStageRes) . ',';
            $returnString .= '中（ ' . substr($winNumberString, 1) . ' ）【' . $winNumber . '个】';
            $returnString .= '，参考' . $resourceStage . '期' . $resourceStageResString;
            $returnString .= '<br>';
            if (count($prevSevenToTenRes) == 0) {
//                换期
                $resourceStage = $i + 1;
                $prevSevenToTenRes = $this->getSevenToTenNumber($res[$i]);
            }
        }
        return $returnString;
    }

    function getSevenToTenNumber($data)
    {
        if (is_array($data) && !empty($data)) {

            $sevenToTenNumberArr = [];
            $sevenToTenNumberArr['seven'] = isset($data['seven']) && $data['seven'] ? $data['seven'] : '';
            $sevenToTenNumberArr['eight'] = isset($data['eight']) && $data['eight'] ? $data['eight'] : '';
            $sevenToTenNumberArr['nine'] = isset($data['nine']) && $data['nine'] ? $data['nine'] : '';
            $sevenToTenNumberArr['ten'] = isset($data['ten']) && $data['ten'] ? $data['ten'] : '';
            return $sevenToTenNumberArr;
        }
        return false;
    }

    function unsetResByValue($data, $val)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($value == $val) {
                    unset($data[$key]);
                }
            }
            return $data;
        }
        return false;
    }


    public function actionThreenextsingle()
    {

        $res = $this->getKjRes();
        $count = count($res);

        $threeRank = $this->getThreeRank($res[0]);


        $winCount = 0;
        $string = "第1期：第" . $this->transFromNumber($threeRank) . "名：3号";

        for ($i = 1; $i < $count; $i++) {
            if (isset($res[$i][$threeRank]) && $res[$i][$threeRank]) {
                $isWin = false;
                if ($res[$i][$threeRank] % 2 !== 0) {
                    //单数
                    $winCount += 1;
                    $isWin = true;
                }
                $string .= "第" . ($i + 1) . "期：第" . $this->transFromNumber($threeRank) . "名：{$res[$i][$threeRank]}号，";
                $threeRank = $this->getThreeRank($res[$i]);
                $string .= "第" . ($i + 1) . "期：第" . $this->transFromNumber($threeRank) . "名：3号，" . ($isWin == true ? '中,' : '');
                $string .= '<br>';

            }
        }
        echo $string . '中奖期数:' . $winCount;


        die;
    }

    function getThreeRank($res)
    {
        $rank = '';
        foreach ($res as $k => $v) {
            if ($v == 3) {
                $rank = $k;
            }
        }
        return $rank;
    }


    public function actionFive(){
        $res = $this->getKjRes();
        $res = $this->oneToSix($res);
        echo $res;
    }

}