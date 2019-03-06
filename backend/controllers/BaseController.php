<?php

namespace backend\controllers;

use yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $menu = [];
    public $user = [];

    public function beforeAction($action)
    {
        $this->getModelName();
        $this->menu = Yii::$app->params['menu_list'];
        $this->user = Yii::$app->session->get('userInfo') ? Yii::$app->session->get('userInfo') : [];
        if($this->user == [] || (time() - $this->user['expire'] >= 3600*24)){
            $this->toIndex();
        }
        return true;
    }

    public function toIndex(){
        $this->redirect('/site/login');
        Yii::$app->end();
    }

    public function rand()
    {
        $str = 'qwertyuiopasdfghjklzxcvbnm';
        $arr = str_split($str);
        $len = rand(5, 10);
        $name = '';
        for ($i = 0; $i < $len; $i++) {
            $name .= $arr[rand(1, 26) - 1];
        }
        return $name;
    }

    public function randPhone()
    {

        $phone = '1';
        for ($i = 0; $i < 10; $i++) {
            $phone .= rand(0, 9);
        }
        return $phone;

    }

    public function getModelName($m_name='主页', $c_name='列表')
    {
        $view = Yii::$app->view;
        $view->params['m_name'] = $m_name;
        $view->params['c_name'] = $c_name;
    }

    public function getRand($len = 11)
    {
        $number = '';
        for ($i = 0; $i < $len; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }

}