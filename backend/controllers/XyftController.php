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
        $res = Xyft::find()
            ->asArray()
            ->orderBy('stage')
            ->all();
        $count = count($res);
//        $stage = 1;
        $oneArray = [];
        for ($i = 0; $i < $count; $i++) {
            if (!isset($res[$i]['one'])) {
                echo $i;
                continue;
            }
            $one = $res[$i]['one'];
            $guess = implode(',', $this->getFiveRandNumber());
            $guessRes = (strpos($guess, $one)) ? '中' : '黑';
            $oneArray[] = $one;
            echo '第' . ($i+1) . '期开奖:' . $one;
            echo '<br>';
            echo '前' . ($i+1) . '期:&nbsp;&nbsp;&nbsp;&nbsp;';
            $chanceArray = array_count_values($oneArray);
            arsort($chanceArray);
            foreach ($chanceArray as $k => $v) {
                $str = $k . ':' . number_format($v / ($i+1), 2) * 100 . '%;&nbsp;&nbsp;';
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
        if($model->load(Yii::$app->request->post()) && $model->validate()){
//            $data = Yii::$app->request->post();
//            print_r($data);die;
            $res = $model->addInfo();
            if($res){
                Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect('/xyft/add');
            }else{
                Yii::$app->session->setFlash('error','添加失败');
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

}