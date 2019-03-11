<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\db\Command;

class BookCenter extends BaseModel
{

    public $name;
    public $code;
    public $manager;
    public $cost;

    public function rules()
    {

        return [
            ['name', 'required', 'message' => '购书中心名称不能为空'],
            ['code', 'required', 'message' => '购书中心编号不能为空'],
            ['manager', 'required', 'message' => '购书中心管理员名称不能为空'],
            ['cost', 'required', 'message' => '购书中心花费不能为空'],
        ];

    }


    public function getList($page, $limit)
    {
        $begin = ($page-1) * $limit;
        $res = Yii::$app->db->createCommand("select `id`,`name`,`code`,`manager`,`cost`,`create_time` from center_info where is_valid=:is_valid limit $begin,$limit")
            ->bindValue(':is_valid', 1)
            ->queryAll();
        if ($res) {
            $count = $this::getCount('center_info');
            return $this::returnData($res, $count);
        }
        return false;
    }


    public function addInfo($data)
    {
        $db = Yii::$app->db;
        $res = $db->createCommand()->insert('center_info', [
            'name' => $data['name'],
            'code' => $data['code'],
            'manager' => '',
            'cost' => $data['cost'],
            'is_valid' => 1,
            'create_id' => 4,
            'create_time' => date('Y-m-d H:i:s')
        ])->execute();
        return $res;
    }

    public function getArea()
    {
        $res = Yii::$app->db->createCommand('select * from `area` where `parentid` in (440100,440300,441400)')->queryAll();
        return $res;
    }

}