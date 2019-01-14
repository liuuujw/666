<?php
namespace backend\controllers;

use backend\models\Book;
use backend\models\Purchasing;

class PurchasingController extends BaseController{

    public $m_name = '采购记录';
    public function actionIndex(){
        $this->getModelName($this->m_name);
        $model = new Purchasing();
        $res = $model->getList();
        $data = $res ?$res: '';
        return $this->render('list',['data'=>$data]);
    }

    function addPurchasing(){
        $book_model = new Book();
        $book_res = $book_model->getList();
        $book_res = (isset($book_res['data']) && $book_res['data']) ? $book_res['data'] : '';
        $count = count($book_res);
        $purchase_res = [];
        if($book_res){
            foreach($book_res as $key=>$val){
                $info['book_id'] = $val['id'];
                $info['book_name'] = $val['book_name'];
                $info['purchase_number'] = $val['total'];
                $info['purchase_price'] = $val['purchasing_price'];
                $info['create_id'] = 4;
                $info['create_time'] = date('Y-m-d H:i:s',time()-$count+$key);
                $purchase_res[] = $info;
            }
        }
        $model = new Purchasing();
        $res = $model->addInfo($purchase_res);
        print_r($res);
        die;
        return false;
    }

}