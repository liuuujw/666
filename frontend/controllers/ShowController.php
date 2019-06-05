<?php

namespace frontend\controllers;

use yii;
use yii\base\Controller;
use yii\db\Command;

class ShowController extends Controller
{

    public $layout = 'show';
    public function actionIndex(){
        return $this->render('index');
    }

}
