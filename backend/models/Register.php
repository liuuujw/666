<?php
namespace backend\models;

use yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Register extends ActiveRecord{

    public $username;
    public $password;
    public $name;
    public $phone;
    public $age;




}