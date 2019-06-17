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

    public function actionJxzy(){
        return $this->render('jxzy');
    }

    public function actionPpt(){
        return $this->render('ppt');
    }

    public function actionTzyd(){
        return $this->render('read');
    }

    public function actionThink(){
        return $this->render('think');
    }

    public function actionVideo(){
        return $this->render('video');
    }

    public function actionJxsj(){
        return $this->render('jxsj');
    }

    public function actionStudent(){
        return $this->render('student');
    }

    //评价
    public function actionEvaluate()
    {
        return $this->render('evaluate');
    }

}
