<?php

namespace backend\controllers;

use yii;

class TestController extends BaseController
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'lastModified' => function () {
                    return 123456;
                }
            ]
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');

    }


}