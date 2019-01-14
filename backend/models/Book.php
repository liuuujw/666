<?php

namespace backend\models;

use yii;
use yii\base\Model;
use common\models\Common;

class Book extends Model
{

    public $book_name;
    public $book_number;
    public $department_id;
    public $publisher_id;
    public $warehouse_id;
    public $specifications;
    public $purchasing_cost;        //成本价格
    public $sell_price;
    public $wholesale_price;        //批发价格
    public $total;
    public $sale_number;

    public function rules()
    {
        return [
            ['book_name', 'default'],
            ['book_number', 'default'],
            ['department_id', 'default'],
            ['publisher_id', 'default'],
            ['warehouse_id', 'default'],
            ['specifications', 'default'],
            ['purchasing_cost', 'default'],
            ['sell_price', 'default'],
            ['wholesale_price', 'default'],
            ['total', 'default'],
            ['sale_number', 'default'],
        ];
    }

    public function getList(){
        $sql = 'SELECT
 b.id, 
 b.book_code, 
 b.book_name, 
 b.editor, 
 b.purchasing_price, 
 b.wholesale_price, 
 b.sell_price, 
 b.total,
 b.sold_number,
 p.name AS publisher_name,
 w.name AS warehouse_name
FROM `book` AS b
LEFT JOIN `publisher` AS p ON
b.publisher_id = p.id
LEFT JOIN warehouse AS w
ON b.warehouse_id = w.id
where b.is_valid=1;';
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if($res){
            return array('code'=>200,'msg'=>'ok','data'=>$res);
        }
        return false;
    }


    public function addData(array $data)
    {
        if (!is_array($data)) {
            return false;
        }
        $column = ['book_name','editor','publisher_id','warehouse_id','purchasing_price','wholesale_price','sell_price','total','sold_number','create_id','create_time'];
        $res = Yii::$app->db->createCommand()->batchInsert('book', $column, $data)
            ->execute();
        return $res;
    }


    public function getEmptyEditor(){
        $sql = "select id from book where editor=''";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        $common = new Common();
        $query_res = array(
            'success_count'=>0,
            'error_res' => array(),
        );
        foreach($res as $v){
            $sql = "update book set editor='" . $common->getName() . "' where id=" . $v['id'];
            $res = Yii::$app->db->createCommand($sql)->execute();
            if($res){
                $query_res['success_count'] += 1;
            }else{
                $query_res['error_res'][] = $v['id'];
            }
        }
        print_r($res);die;
        return $res;
    }

}