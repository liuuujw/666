<?php

namespace backend\controllers;

use yii;
use yii\base\Controller;

class LngController extends Controller
{

    public function actionIndex()
    {
        $str = file_get_contents('./location.txt');
        $arr = json_decode($str, JSON_UNESCAPED_UNICODE);
        $ak = '3Bu4d1SurNxInqocMnfZsEQ0';
        $url = 'http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=' . $ak;
//        $content = file_get_contents($url);
//        print_r($content);

        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        print_r($data);


        die;

    }

}