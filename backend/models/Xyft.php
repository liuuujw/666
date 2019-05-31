<?php
namespace backend\models;

use yii;
use yii\db\ActiveRecord;

class Xyft extends ActiveRecord{

    public static function tableName(){
        return '{{xyft}}';
    }

    public static function getDb()
    {
        return Yii::$app->dbol;
    }

}