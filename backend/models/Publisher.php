<?php
namespace backend\models;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 11:46
 */
use yii;
use yii\base\Model;
use yii\db\Command;

class Publisher extends Model{

    public $publisher_name;
    public $publisher_code;
    public $publisher_phone;
    public $publisher_address;

    public function rules(){
        return [
            ['publisher_name','default'],
            ['publisher_code','default'],
            ['publisher_phone','default'],
            ['publisher_address','default'],
        ];
    }

    public function getList(){

        $res = Yii::$app->db->createCommand('select `id`,`name`,`code`,`phone`,`address`,`create_time` from publisher where is_valid=1')->queryAll();
        if(is_array($res) && count($res) >= 1){
            return $res;
        }
        return false;
    }


    public function add($info){
        $res = Yii::$app->db->createCommand()->insert('publisher',[
            'name'=>$info['name'],
            'phone'=>$info['phone'],
            'create_id'=>4,
            'create_time'=>date('Y-m-d H:i:s'),
        ])->execute();
        return $res;
    }

    public function updateAddress($address_arr){
        $return = [];
        foreach($address_arr as $key=>$val){
            $res = Yii::$app->db->createCommand()->update('publisher',['address'=>$val],"id=($key+1)")->execute();
            if($res){
                $return[$key] = true;
            }else{
                $return[$key] = false;
            }
        }
        var_dump($return);
    }

}