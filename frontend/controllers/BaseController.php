<?php

namespace frontend\controllers;

use yii;
use yii\base\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if ( preg_match( '/MSIE/i',  $agent)){
            echo '请用非IE浏览器浏览，如谷歌浏览器、火狐浏览器等。';
            die;
        }
        return true;
    }
}