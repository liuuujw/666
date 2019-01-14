<?php

namespace backend\controllers;

use backend\models\BookCenter;
use backend\models\Staff;
use yii;
use common\models\Common;

class StaffController extends BaseController
{
    public $m_name = '员工管理';

    public function actionIndex()
    {

        $this->getModelName($this->m_name);
        $model = new Staff();
        $data = $model->getList();
        return $this->render('list', ['data' => $data]);
    }

    public function actionEdit()
    {

        $c_name = Yii::$app->request->get('t') == 'add' ? '添加' : '编辑';
        $this->getModelName($this->m_name, $c_name);

        $model = new Staff();

        return $this->render('edit', ['model' => $model]);

    }

    public function actionGetdata()
    {
        $common = new Common();
        $model = new Staff();
        for ($i = 0; $i <= 99; $i++) {
            $info = array(
                'name' => $common->getName(),
                'age' => rand(18, 50),
                'gender' => rand(0, 1),
                'wages' => rand(2000, 20000)
            );
            $model->add($info);
        }
    }

    public function actionUpdate()
    {

        $title_id_arr = [2, 4, 31, 32, 17, 27, 4];
        for($i=1;$i<=30;$i++){
            $res = Staff::getData($i);
            $wages = 20000;
            foreach ($res as $key => &$val) {
                if ($key < 7) {
                    $val['title'] = $title_id_arr[$key];
                    $val['wages'] = rand($wages - 2000, $wages);
                } elseif ($key >= 7 && $key < 11) {
                    $val['title'] = 20;
                    $val['wages'] = rand(10000, 15000);
                } elseif ($key >= 11 && $key < 12) {
                    $val['title'] = 24;
                    $val['wages'] = rand(7000, 10000);
                } elseif ($key >= 12 && $key < 20) {
                    $val['title'] = 31;
                    $val['wages'] = rand(3000, 5000);
                } elseif ($key >= 20 && $key < 21) {
                    $val['title'] = 26;
                    $val['wages'] = rand(5000, 8000);
                } elseif ($key >= 21 && $key < 23) {
                    $val['title'] = 29;
                    $val['wages'] = rand(5000, 7000);
                } elseif ($key >= 23 && $key < 26) {
                    $val['title'] = 16;
                    $val['wages'] = rand(4000, 6000);
                } elseif ($key >= 26 && $key < 34) {
                    $val['title'] = 14;
                    $val['wages'] = rand(3000, 4500);
                } elseif ($key >= 34 && $key < 36) {
                    $val['title'] = 12;
                    $val['wages'] = rand(3000, 4500);
                } elseif ($key >= 36 && $key < 38) {
                    $val['title'] = 9;
                    $val['wages'] = rand(3000, 4500);
                } elseif ($key == 38) {
                    $val['title'] = 5;
                    $val['wages'] = rand(4000, 6000);
                }elseif($key == 39){
                    $val['title'] = 36;
                    $val['wages'] = rand(6000, 8000);
                }
                $wages = ceil($val['wages'] / 100) * 100;
                $title = $val['title'];
                $update_res = Staff::updateTitle($val['id'],$title,$wages);
                if(!$update_res){
                    echo $val['id'] . '<br>';
                }
            }
        }

        unset($val);
        print_r($res);
        die;

    }

}