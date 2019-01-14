<?php
namespace backend\models;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-22
 * Time: 11:03
 */

use yii;
use yii\base\Model;

class Warehouse extends Model{

    public $number;
    public $manager;
    public $phone;
    public $cost;

    public function rules(){
        return [
            ['number','default'],
            ['manager','default'],
            ['phone','default'],
            ['cost','default'],
        ];
    }

    public function getList(){
        $res = Yii::$app->db->createCommand('SELECT
w.id, 
w.name, 
w.code,
s.name AS manager,
s.phone,
w.operating_costs,
c.name AS center_name
FROM `warehouse` AS w
LEFT JOIN `center_info` AS c
ON w.center_info_id = c.id
LEFT JOIN staff AS s
ON w.manager=s.id
WHERE
w.is_valid=1;')
            ->queryAll();
        return $res;
    }

    public function add($info){

        $res = Yii::$app->db->createCommand()->insert('warehouse',[
            'name'=>$info['name'],
            'operating_costs'=>$info['operating_costs'],
            'department_id'=>$info['department_id'],
            'create_id'=>4,
            'create_time'=>date('Y-m-d H:i:s'),
        ])->execute();
        return $res;

    }

}