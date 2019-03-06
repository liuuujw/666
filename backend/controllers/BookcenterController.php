<?php

namespace backend\controllers;

use yii;
use yii\base\Controller;
use backend\controllers\BaseController;
use backend\models\BookCenter;
use common\models\Common;

class BookcenterController extends BaseController
{

    public $m_name = '购书中心管理';

    public function actionIndex()
    {

        $this->getModelName($this->m_name, '列表');
        $model = new BookCenter();
        $data = $model->getList();

        /*if (!$data) {
            $common = new Common();
            $res = $model->getArea();
            foreach ($res as $key => $val) {
                $one['id'] = $key + 1;
                $one['name'] = $val['shortname'] . '购书中心<br>';
                $one['code'] = $val['id'] . ($key + 1);
                $one['manager'] = $common->getName();
                $one['is_valid'] = 1;
                $one['create_time'] = date('Y-m-d H:i:s');
                $one['cost'] = rand(1000000, 9999999);
                $data[] = $one;
            }
        }*/
        return $this->render('book_center_list', ['data' => $data]);

    }

    public function actionAdd()
    {

        $this->getModelName($this->m_name, '添加');
        $model = new BookCenter();
        return $this->render('add_book_center_info', ['model' => $model]);

    }


    public function actionTest()
    {
        echo phpinfo();
    }

}