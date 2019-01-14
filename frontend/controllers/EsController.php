<?php
namespace frontend\controllers;

use yii;
use yii\base\Controller;
use frontend\models\Es;

class EsController extends Controller{

    public function actionIndex(){
        $model = new Es();
        return $model->getOne();
    }

}