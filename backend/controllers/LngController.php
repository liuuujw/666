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
        $url = 'http://api.map.baidu.com/geocoder/v2/?address=�����к������ϵ�ʮ��10��&output=json&ak=' . $ak;
//        $content = file_get_contents($url);
//        print_r($content);

        $curl = curl_init();
        //����ץȡ��url
        curl_setopt($curl, CURLOPT_URL, $url);
        //����ͷ�ļ�����Ϣ��Ϊ���������
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //���û�ȡ����Ϣ���ļ�������ʽ���أ�������ֱ�������
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //ִ������
        $data = curl_exec($curl);
        //�ر�URL����
        curl_close($curl);
        //��ʾ��õ�����
        print_r($data);


        die;

    }

}