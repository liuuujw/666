<?php
namespace backend\models;

use yii;
use yii\base\Model;

class Sale extends Model{

    public $book_name;
    public $price;
    public $sold_number;
    public $total_price;

    public function rules(){

        return [
            ['book_name','default'],
            ['price','default'],
            ['sold_number','default'],
            ['total_price','default'],
        ];

    }

    public function getList()
    {
        $sql = "SELECT 
sr.id,
ci.name AS center_info_name,
sr.book_name,
sr.sold_price,
sr.sold_number,
sr.total_discount,
sr.total_price,
sr.create_time
FROM sold_record AS sr
LEFT JOIN center_info AS ci
ON sr.center_info_id = ci.id
WHERE sr.is_valid=1
ORDER BY create_time DESC
LIMIT 0,1000;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function addInfo($sale){
//        $column = ['book_id','book_name','sold_number','sold_price','total_discount','total_price'];
        $res = Yii::$app->db->createCommand()->insert('sold_record',$sale)->execute();
        if($res){
            return $res;
        }else{
            return false;
        }

    }

}