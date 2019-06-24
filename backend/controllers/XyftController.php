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
        $date = date('Y-m-d');
        $kjtime = $date . ' 12:00:00';
        $res = Xyft::find()
            ->andWhere(['>', 'kjtime', $kjtime])
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
            $guessRes = (strpos($guess, $one)) ? '��' : '��';
            $oneArray[] = $one;
            echo '��' . substr($res[$i]['stage'], 8) . '�ڿ���:' . $one;
            echo '<br>';
            echo 'ǰ' . $stageCount . '��:&nbsp;&nbsp;&nbsp;&nbsp;';
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


//                echo '<br>'.($i+1).'�ڿ���:'.$one . ';&nbsp;&nbsp;' . $guess . ';&nbsp;&nbsp;' . $guessRes;


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
                $model->kjdate = substr($value['date'], 0, 10);
                $model->save() && $model->id=0;
            }
        }
    }

}