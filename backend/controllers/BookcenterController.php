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
//        $model = new CenterInfo();
//        $data = $model->getList();

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
        return $this->render('book_center_list');

    }

    public function actionGetdata()
    {
        $page = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1;
        $limit = Yii::$app->request->get('limit') ? Yii::$app->request->get('limit') : Yii::$app->params['defaultLimit'];
        $model = new BookCenter();
        $data = $model->getList($page, $limit);
        return $data;
    }

    public function actionAdd()
    {
        if (Yii::$app->request->isAjax) {
            $model = new BookCenter();
            $data = Yii::$app->request->post() ? Yii::$app->request->post() : [];
            return $data;
        }


    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id') ? Yii::$app->request->get('id') : '';
        if ($id == '') {
            return false;
        }
        $model = new BookCenter();
        $res = $model::getOne($id);
        return $res;
    }


    public function actionTest()
    {
        echo phpinfo();
    }

    public function actionDel()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : '';
        if ($id != '') {
            $model = new BookCenter();
            $res = $model::delete($id);
            print_r($res);
            die;
        }
        return false;
    }

    public function actionSave()
    {
        $postData = Yii::$app->request->post() ? Yii::$app->request->post() : '';
        $model = new BookCenter();
        if (isset($postData['id']) && $postData['id'] == '') {
            //添加
        } else {
            //修改
        }
    }

}