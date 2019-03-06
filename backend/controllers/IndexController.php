<?php

namespace backend\controllers;

use yii;
use yii\base\Controller;
use backend\models\BookCenter;
use yii\db\Command;
use yii\db\Connection;

class IndexController extends BaseController
{


    public function actionIndex(){
        return $this->render('table');

    }


    public function actionForm(){

        $model = new BookCenter();
        return $this->render('form',['model'=>$model]);

    }




}