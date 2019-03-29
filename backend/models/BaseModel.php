<?php

namespace backend\models;

use yii;
use yii\base\Model;

class BaseModel extends Model
{


    public static function getCount($table_name){
        $res = Yii::$app->db->createCommand('select count(*) as `total` from '.$table_name.' where is_valid=:is_valid')
            ->bindValue(':is_valid',1)
            ->queryOne();
        return $res['total'];
    }

    public static function returnData($data,$total=1,$msg='ok'){

        if(is_bool($data)){
            $return = [];
            if($data == true){
                $return['code'] = 200;
                $return['msg'] = $msg;
            }else{
                $return['code'] = 400;
                $return['msg'] = 'error';
            }
            return json_encode($return,JSON_UNESCAPED_UNICODE);
        }
        $return = [
            //layui table要求有返回数据是 code=0
            'code' => 0,
            'msg' => $msg,
            'count' => $total,
            'data' => []
        ];
        if(!is_array($data) || count($data) == 0){
            $return['code'] = 400;
        }else{
            $return['data'] = $data;
        }
        return json_encode($return,JSON_UNESCAPED_UNICODE);

    }

}
