<?php

namespace backend\models;

use common\models\Common;
use yii;
use yii\base\Model;

class Department extends Model
{

    public $name;
    public $code;
    public $manager;
    public $address;
    public $phone;
    public $month_cost;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => '名称不能为空'],
            ['code', 'required', 'message' => '编号不能为空'],
            ['manager', 'required', 'message' => '管理员不能为空'],
            ['address', 'required', 'message' => '地址不能为空'],
            ['phone', 'default'],
            ['month_cost', 'default'],
        ];
    }

    public function getList()
    {
        $sql = "SELECT 
d.id, d.name, c.name AS center_name, d.code, s.name AS manager_name , d.address, d.phone, d.per_month_cost, d.create_time
FROM `department` AS d
LEFT JOIN `center_info` AS c
ON d.center_info_id = c.id
LEFT JOIN staff AS s
ON d.manager_id=s.id
WHERE d.is_valid=1
AND c.is_valid=1;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if ($res) {
            return $res;
        }
        return false;

    }

    public function add($info)
    {

        $res = Yii::$app->db->createCommand()->insert('department', [
            'name' => $info['name'],
            'center_id' => $info['center_id'],
            'phone' => $info['phone'],
            'per_month_cost' => $info['per_month_cost'],
            'create_id' => 4,
            'create_time' => date('Y-m-d H:i:s'),
        ])->execute();

        return $res ? true : false;

    }

    public function update(){
        $sql  = "select * from department";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($res as $key => $val){
            $title_name = mb_substr($val['name'],0,mb_strlen($val['name'])-1);
            if($title_name == '人力资源'){
                $title_name = '人事';
            }elseif($title_name == '维护'){
                $title_name = '技术';
            }elseif ($title_name == '营销'){
                $title_name = '销售';
            }elseif($title_name == '客户服务'){
                $title_name = '客服';
            }
            $title_name .= '总监';
            $t_sql = "select id from title where title_name = '$title_name';";
            $title_res = Yii::$app->db->createCommand($t_sql)->queryOne();
            if(empty($title_res)){
                echo $t_sql;die;
            }
            $staff_sql = "select * from staff where title=".$title_res['id']." and center_info_id = ".$val['center_info_id'].";";
            $staff_res = Yii::$app->db->createCommand($staff_sql)->queryOne();
            Yii::$app->db->createCommand()->update('department',['manager_id'=>$staff_res['id']],"id=".$val['id'])->execute();
        }
        die;
    }

    function getYuanGong($c_id,$t_id){
        $zongjian = [
            'name'=>Common::getName(),
            'center_info_id'=>(int)$c_id,
            'age'=>rand(25,40),
            'gender'=>rand(0,1),
            'phone'=>Common::getPhone(),
            'title'=>$t_id,
            'wages'=>ceil(rand(7000,10000)/100) * 100,
            'create_time'=>date('Y-m-d H:i:s'),
        ];
        $this->insertStaff($zongjian);

        $times = rand(2,5);
        for($i=0;$i<$times;$i++){
            $staff = [
                'name'=>Common::getName(),
                'center_info_id'=>(int)$c_id,
                'age'=>rand(25,40),
                'gender'=>rand(0,1),
                'phone'=>Common::getPhone(),
                'title'=>$t_id+1,
                'wages'=>ceil(rand(3000,5500)/100) * 100,
                'create_time'=>date('Y-m-d H:i:s'),
            ];
            $this->insertStaff($staff);
        }
    }

    public function insertStaff($staff)
    {

        $res = Yii::$app->db->createCommand()->insert('staff',$staff)->execute();
        return $res;
    }

}