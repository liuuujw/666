<?php

namespace backend\controllers;

use backend\models\Book;
use yii;
use yii\web\Controller;
use backend\controllers\BaseController;

class BookController extends BaseController
{

    public $layout = 'main_v2';
    public $m_name = '书籍管理';

    public function actionIndex()
    {

        $this->getModelName($this->m_name, '列表');
        $model = new Book();
        $res = $model->getList();
        $data = (isset($res['data']) && $res['data']) ? $res['data'] : '';
//        print_r($data);die;
        return $this->render('list', ['data' => $data]);

    }


    public function actionEdit()
    {

        $type = Yii::$app->request->get('t')=='add' ? '添加' : '编辑';
        $this->getModelName($this->m_name, $type);
        $model = new Book();

        return $this->render('edit', ['model' => $model]);

    }

    public function actionGetbookdata(){

        $content = file_get_contents('./data_resource/book_name.txt');
        $book_res = explode("\r\n", $content);
        $book_res_arr = [];
        foreach($book_res as $book){
            $info_res = explode("--", $book);
            $info['book_name'] = $info_res[0];
            $info['editor'] = (isset($info_res[1]) && $info_res[1]) ? $info_res[1] : '';
            $book_res_arr[] = $info;
        }
        foreach($book_res_arr as &$val) {
            $val['publisher_id'] = rand(1, 180);
            $val['warehouse_id'] = rand(1, 91);
            $val['purchasing_price'] = rand(20, 2000) + (rand(0, 99) / 100);                //采购价格
            $val['wholesale_price'] = bcmul($val['purchasing_price'], (1 + (rand(0, 99) / 100)), 2); //批发价格
            $val['sell_price'] = bcmul($val['wholesale_price'], (1 + (rand(0, 99) / 100)), 2);       //销售价格
            $val['total'] = rand(1000,100000);
            $val['sold_number'] = (int)$val['total'] * (rand(0,99) / 100);
            $val['create_id'] = 4;
            $val['create_time'] = date('Y-m-d H:i:s');
        }

        unset($val);
        $model = new Book();
        $result = $model->addData($book_res_arr);
        print_r($result);
        die;

    }

    public function actionAddeditor(){
        $model = new Book();
        $res = $model->getEmptyEditor();
        print_r($res);

    }

}