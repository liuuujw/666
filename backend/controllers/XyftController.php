<?php

namespace backend\controllers;

use yii;
use backend\models\Xyft;
use backend\models\XyftForm;

class XyftController extends yii\web\Controller
{

    public function actionIndex()
    {
        header("Content-type:text/html; charset=GBK");
        if(date('H') > 13){
            $kjtimeBegin = date('Y-m-d') . ' 13:00:00';
        }
        $kjtimeBegin = date('Y-m-d', strtotime('-1 days')) . ' 13:00:00';
        $kjtimeEnd = date('Y-m-d') . ' 12:00:00';
        $res = Xyft::find()
            ->andWhere(['>', 'kjtime', $kjtimeBegin])
            ->andWhere(['<', 'kjtime', $kjtimeEnd])
            ->asArray()
            ->orderBy(['stage'=>SORT_ASC])
            ->all();


        $count = count($res);
//        print_r($res);die;
//        $stage = 1;
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
            $guessRes = (strpos($guess, $one)) ? '中' : '黑';
            $oneArray[] = $one;
            echo '第' . substr($res[$i]['stage'], 8) . '期开奖:' . $one;
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
            echo '<br>';


//                echo '<br>'.($i+1).'期开奖:'.$one . ';&nbsp;&nbsp;' . $guess . ';&nbsp;&nbsp;' . $guessRes;


        }
        die;
    }

    public function actionAdd()
    {
        $this->layout = 'main';
        $model = new XyftForm();
        $msg = '';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $data = Yii::$app->request->post();
//            print_r($data);die;
            $res = $model->addInfo();
            if ($res) {
                Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect('/xyft/add');
            } else {
                Yii::$app->session->setFlash('error', '添加失败');
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
            if(!$model::find()->where(['stage'=>$value['number']])->one()){
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
                $model->kjdate = substr($value['number'],0,4) . '-'. substr($value['number'],4,2) . '-' . substr($value['number'],6,2);
                $model->save() && $model->id=0;
            }
        }
    }

    public function actionGetres(){
        $string = file_get_contents('https://www.568kj1.com/ft/xyft.php');
        $preg = '/<span.*>(.*)<\/span>/isU';
        $numberPreg = '/<h2.*>(.*([0-9]{11}).*)<\/h2>/isU';
        preg_match_all($numberPreg, $string,$numberRes);
        preg_match_all($preg, $string,$res);
        $number = $numberRes[2][0];
        $model = new Xyft();
        if(!$model::find()->where(['stage'=>$number])->one()){
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
            $model->kjdate = substr($number,0,4) . '-'. substr($number,4,2) . '-' . substr($number,6,2);
            return $model->save();
        }

        return false;
    }

}