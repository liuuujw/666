<?php

namespace common\models;

use yii;
use yii\base\Model;

class Common extends Model
{

    public static function getName()
    {
        $x_str = file_get_contents('./data_resource/xingshi.txt');
        $x_str = str_replace(' ', '', $x_str);
        $x_str = str_replace("\r\n", '', $x_str);
        $xing_arr = preg_split('/(?<!^)(?!$)/u', $x_str);

        $hanzi_str = file_get_contents('./data_resource/chinese.txt');
        $hanzi_str = str_replace(' ', '', $hanzi_str);
        $hanzi_str = str_replace("\r\n", '', $hanzi_str);
        $hanzi_arr = preg_split('/(?<!^)(?!$)/u', $hanzi_str);

        $xing_arr_length = count($xing_arr) - 1;
        $hanzi_arr_length = count($hanzi_arr) - 1;
        $name = $xing_arr[rand(0, $xing_arr_length - 1)] . $hanzi_arr[rand(0, $hanzi_arr_length - 1)];

        if (rand(1, 2) == 2) {
            $name .= $hanzi_arr[rand(0, $hanzi_arr_length - 1)];
        }

        return $name;

    }

    public static function getPhone()
    {

        $arr = array(
            130, 131, 132, 133, 134, 135, 136, 137, 138, 139,
            144, 147,
            150, 151, 152, 153, 155, 156, 157, 158, 159,
            176, 177, 178,
            180, 181, 182, 183, 184, 185, 186, 187, 188, 189,
        );
        return $arr[array_rand($arr)] . ' ' . mt_rand(1000, 9999) . ' ' . mt_rand(1000, 9999);

    }

    public function getAllArea()
    {
        $res = Yii::$app->db->createCommand('select * from `area`;')->queryAll();
        return $res;
    }

    public function getProvinceByName($city_name)
    {
        $res = Yii::$app->db->createCommand("select * from `area` where `areaname` like '" . $city_name . "%' and `parentid`=1;")->queryAll();
        return $res;
    }

    public function getCityById($id)
    {
        $sql = 'select * from `area` where `parentid`=' . $id;
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function getRandomArea()
    {
        $area_str = '';

        $sql = 'select * from `area` where `parentid` = 1';
        $province_res = Yii::$app->db->createCommand($sql)->queryAll();
        $province_info = $province_res[rand(0, count($province_res) - 1)];    //省

        if ($province_info['shortname'] != $province_info['areaname']) {
            $area_str .= $province_info['areaname'];
        }

        $sql_city = 'select * from `area` where `parentid` = ' . $province_info['id'];
        $city_res = Yii::$app->db->createCommand($sql_city)->queryAll();
        if (count($city_res)) {
            $city_info = $city_res[rand(0, count($city_res) - 1)];
            $area_str .= $city_info['areaname'];
            $sql_district = 'select * from `area` where `parentid` = ' . $city_info['id'];
            $district_res = Yii::$app->db->createCommand($sql_district)->queryAll();
            if (count($district_res)) {
                $district_info = $district_res[rand(0, count($district_res) - 1)];
                $area_str .= $district_info['areaname'];
            }
        }
        return $area_str . $this->getAddress();
    }

    public function getAddress(){
        $name = $this->getChinese();
        $floor = rand(1,60);
        $name .= '路'.rand(1,900) . '号'. rand(1,10) . '栋' . $floor . '楼';
        if(rand(0,1)){
            $unit = rand(1,20);
            $name .= $floor. ($unit < 10 ? '0'.$unit : $unit);
        }else{
            $name .= '全层';
        }
        return $name;
    }


    public function getChinese($len_begin = 2, $len_end = 5){
        $name = '';
        $hanzi_str = file_get_contents('./data_resource/chinese.txt');
        $hanzi_str = str_replace(' ', '', $hanzi_str);
        $hanzi_str = str_replace("\r\n", '', $hanzi_str);
        $hanzi_arr = preg_split('/(?<!^)(?!$)/u', $hanzi_str);
        $hanzi_arr_length = count($hanzi_arr) - 1;
        $name_length = rand($len_begin,$len_end);
        for($i=0;$i<$name_length;$i++){
            $name .= $hanzi_arr[rand(0, $hanzi_arr_length - 1)];
        }

        return $name;
    }

}