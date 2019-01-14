<?php

namespace backend\controllers;

use common\models\Common;
use yii;
use yii\base\Controller;
use backend\controllers\BaseController;
use backend\models\Department;
use backend\models\BookCenter;

class DepartmentController extends BaseController
{

    public $layout = 'main_v2';

    public function actionIndex()
    {
        $this->getModelName('部门管理', '列表');
        $model = new Department();
        $data = $model->getList();
        return $this->render('list', ['data' => $data]);

    }

    public function actionAdd()
    {

        $this->getModelName('部门管理', '添加');
        $model = new Department();
        return $this->render('edit', ['model' => $model]);

    }

    public function actionGetdata()
    {

        $d_model = new Department();
        $res = $d_model->update();
        print_r($res);
        die;

    }



}