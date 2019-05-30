<?php

namespace backend\controllers;

use common\models\Test;
use yii;

class TestController extends yii\web\Controller
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

        $model = new Test();
        $res = $model->test();
        print_r($res);

    }


}