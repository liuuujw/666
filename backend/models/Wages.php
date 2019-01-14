<?php
namespace backend\models;

use yii;
use yii\base\Model;

class Wages extends Model{

    public $staff_name;
    public $money;
    public $time;

    public function rules(){
        return [
            ['staff_name','default'],
            ['money','default'],
            ['time','default'],
        ];
    }

    public function getList(){
        $sql = "SELECT 
 w.id,
 w.wages,
 w.late_times,
 w.buckle_money,
 w.commission,
 w.deductions,
 w.should_pay,
 s.name
FROM wages_record AS w
LEFT JOIN staff AS s
ON w.staff_id = s.id
WHERE w.is_valid=1
AND s.is_valid=1
limit 0,3000;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }


    public function addWagesData($data)
    {
        $return = 0;
        $column = ['staff_id', 'wages', 'late_times', 'buckle_money', 'commission', 'deductions', 'should_pay', 'create_time'];
        $res = Yii::$app->db->createCommand()->batchInsert('wages_record',$column,$data)->execute();
        if($res){
            $return += 1;
        }
        print_r($return);

    }


    public function update($id,$data){
        Yii::$app->db->createCommand()->update('wages_record',$data,"id=$id")->execute();
    }

}