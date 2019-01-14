<?php

namespace backend\controllers;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 11:29
 */

use backend\models\Publisher;
use common\models\Common;
use yii;

class PublisherController extends BaseController
{

    public $m_name = '出版商管理';

    public function actionIndex()
    {

        $this->getModelName($this->m_name);
        $model = new Publisher();
        $data = $model->getList();
        return $this->render('list', ['data' => $data]);

    }

    public function actionEdit()
    {
        $c_name = (Yii::$app->request->get('t') == 'add') ? '添加' : '编辑';
        $this->getModelName($this->m_name, $c_name);
        $model = new Publisher();
        return $this->render('edit', ['model' => $model]);
    }

    public function actionInfo()
    {
        echo date('Y-m-d H:i:s');
        die;
        $content = file_get_contents('./data_resource/publisher.txt');
        $res = explode("\r\n", $content);
        $common = new Common();
        $model = new Publisher();
        foreach ($res as $key => $val) {
            $info['name'] = $val;
            $info['phone'] = $common->getPhone();
            $res = $model->add($info);
            if ($res) {
                echo $key + 1 . '---true<br>';
            }
        }

        die;
    }

    public function actionInsertaddress(){
        $model = new Publisher();
        $common = new Common();
        $data = $model->getList();
        $area_res = [];
        foreach ($data as $key => $val) {
            $city_name = mb_substr(trim($val['name']), 0, 2, 'utf-8');
            $area_str = '';
            $province_res = $common->getProvinceByName($city_name); //省份
            $len = count($province_res);
            if ($len) {
                $province_res = $province_res[0];
                $area_str .= $province_res['areaname'];
                $city_res = $common->getCityById($province_res['id']);  //市
                if (!empty($city_res)) {
                    $city_count = count($city_res);
                    $city_info = $city_res[rand(0, $city_count - 1)];
                    if ($province_res['shortname'] != $province_res['areaname']) {
                        $area_str .= $city_info['areaname'];
                    }
                    $district_res = $common->getCityById($city_info['id']);
                    if (!empty($district_res)) {
                        $district_count = count($district_res) - 1;
                        $district_info = $district_res[rand(0, $district_count)];
                        $area_str .= $district_info['areaname'];
                    }
                }
                $area_res[] = $area_str . $common->getAddress();
            }else{
                $area_res[] = $common->getRandomArea();
            }

        }
        $res = $model->updateAddress($area_res);
//        print_r($area_res);
        die;
    }

}