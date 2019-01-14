<?php

namespace backend\models;

use common\models\Common;
use yii;
use yii\base\Model;
use yii\db\Command;

class Staff extends Model
{

    public $code;
    public $name;
    public $department_id;
    public $age;
    public $gender;
    public $title;
    public $wage;

    public function rules()
    {
        return [
            ['code', 'default'],
            ['name', 'default'],
            ['department_id', 'default'],
            ['age', 'default'],
            ['gender', 'default'],
            ['title', 'default'],
            ['wage', 'default'],
        ];
    }

    public function getList()
    {
        $sql = 'SELECT
s.id,
s.name,
s.code,
c.name AS center_info_name,
s.age,
s.gender,
t.title_name,
s.wages
FROM `staff` AS s
LEFT JOIN `center_info` AS c
ON s.center_info_id = c.id
LEFT JOIN title AS t
ON s.title=t.id
WHERE s.is_valid = 1;';
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if ($res) return $res;
        return false;
    }

    public function add($info)
    {

        $res = Yii::$app->db->createCommand()->insert('staff', [
                'name' => $info['name'],
                'age' => $info['age'],
                'gender' => $info['gender'],
                'wages' => $info['wages'],
                'center_info_id' => $info['center_info_id'],
                'title'=>$info['title'],
                'create_id'=>4,
                'create_time'=>date("Y-m-d H:i:s"),
            ]
        )->execute();
        if ($res) {
            return true;
        }
        return false;
    }


    public static function getData($c_id=1){

        $sql = "SELECT * FROM staff WHERE center_info_id = $c_id ORDER BY wages DESC;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;

    }

    public static function updateTitle($id,$title,$wages){
        $data = ['title'=>$title,'wages'=>$wages];
        $res = Yii::$app->db->createCommand()->update('staff',$data,"id=$id")->execute();
        return $res;
    }

    public function getManager(){
        $sql = 'select * from staff where title=36';
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function addPhone(){
        $sql = 'select * from staff';
        $db = Yii::$app->db;
        $res = $db->createCommand($sql)->queryAll();
        foreach($res as $val){
            $id = $val['id'];
            $db->createCommand()->update('staff',['phone'=>Common::getPhone()],"id=$id")->execute();
        }
    }



}