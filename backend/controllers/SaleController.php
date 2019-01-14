<?php

namespace backend\controllers;

use backend\models\Sale;
use yii;
use backend\models\Book;

class SaleController extends BaseController
{

    public $m_name = '销售记录';

    public function actionIndex()
    {
        $this->getModelName($this->m_name);
        $model = new Sale();
        $res = $model->getList();
        $data = (!empty($res) && $res) ? $res : '';
        return $this->render('list',['data'=>$data]);
    }

    public function actionEdit()
    {

        $type = Yii::$app->request->get('t') == 'add' ? '添加' : '编辑';
        $this->getModelName($this->m_name, $type);

        $model = new Sale();
        return $this->render('edit', ['model' => $model]);
    }

    function splitNumber($number,&$number_arr=array())
    {
        ;
        if ($number < 0) return false;
        $rand = rand(0,200);
        $rest = $number-$rand;
        if($rest>200){
            $number_arr[] = $rand;
            $this->splitNumber($rest,$number_arr);
        }else{
            $number_arr[] = $rest;
            $number_arr[] = $rest;
        }

        return $number_arr;

    }

}