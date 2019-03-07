<?php
namespace backend\controllers;

use yii;

class RoleController extends BaseController{
    public $layout = 'layui';

    public function actionIndex(){
        $this->getModelName('账号管理');

        return $this->render('layui');
    }

    public function actionAdd(){
        $this->getModelName('账号管理');
        return $this->render('layui');
    }

    public function actionTable(){
        $this->getModelName('账号管理');
        return $this->render('table');
    }
}