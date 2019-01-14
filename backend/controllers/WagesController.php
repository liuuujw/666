<?php

namespace backend\controllers;

use backend\models\Staff;
use yii;
use backend\models\Wages;

class WagesController extends BaseController
{

    public $m_name = '工资管理';

    public function actionIndex()
    {
        $this->getModelName($this->m_name);
        $model = new Wages();
        $data = $model->getList();
        return $this->render('list', ['data' => $data]);
    }

    public function actionEdit()
    {
        $type = Yii::$app->request->get('t') == 'add' ? '添加' : '编辑';
        $this->getModelName($this->m_name, $type);
        $model = new Wages();
        return $this->render('edit', ['model' => $model]);

    }


    public function actionUpdate()
    {
        date_default_timezone_set('PRC');
        $model = new Wages();
        $res = $model->getList();
        foreach($res as $val){
            $wages_total = $val['wages'] - $val['buckle_money'] + $val['commission'];
            $money['deductions'] = $wages_total > 5000 ? $this->getDeductions($wages_total) : 0;
            $money['should_pay'] = $wages_total - $money['deductions'];
            $model->update($val['id'],$money);
        }


    }

    function getDeductions($wages)
    {
        if($wages < 5000){
            return $wages;
        }
        $money = $wages - 5000;
        if (0 <= $money && $money < 2910) {
            $final_wages = $money * 0.03;
        } elseif (2910 <= $money and $money < 11010) {
            $final_wages = $money * 0.1 - 210;
        } elseif (11010 <= $money && $money < 21410) {
            $final_wages = $money * 0.2 - 1410;
        } elseif (21410 <= $money && $money < 28910) {
            $final_wages = $money * 0.25 - 2660;
        } elseif (28910 <= $money && $money < 42910) {
            $final_wages = $money * 0.30 - 4410;
        } elseif (42910 <= $money && $money < 59160) {
            $final_wages = $money * 0.35 - 7160;
        } elseif (59160 <= $money) {
            $final_wages = $money * 0.45 - 15160;
        }
        return round($final_wages, 2);
    }

}