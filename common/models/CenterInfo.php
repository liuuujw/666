<?php
namespace common\models;

use yii;
use yii\db\ActiveRecord;

class CenterInfo extends ActiveRecord{

    CONST is_valid = 1;

    public static function tableName(){
        return '{{center_info}}';
    }


}