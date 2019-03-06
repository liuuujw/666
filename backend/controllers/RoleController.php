<?php
namespace backend\controllers;

use yii;

class RoleController extends BaseController{
    public $layout = 'layui';
    public $m_name = '账号管理';
    public function actionIndex(){

        return $this->render('layui');
    }

    public function actionAdd(){

        return $this->render('layui');
    }
}