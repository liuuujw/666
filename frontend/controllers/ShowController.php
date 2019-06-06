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

    public function actionKj(){
        $content = file_get_contents('https://www.568kj1.com/ft/xyft.php');
        preg_match('/<span(([\s\S])*?)<\/span>/',$content,$arr);
        print_r($arr);die;
    }

}
