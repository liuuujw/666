<?php

namespace backend\models;

use yii;

class Purchasing extends BaseModel
{

    public function getList()
    {
        $sql = "SELECT
p.id,
ci.name AS center_info_name,
p.book_name,
p.purchase_number,
p.purchase_price,
p.create_time
FROM purchase AS p
LEFT JOIN center_info AS ci
ON p.center_info_id=ci.id
ORDER BY p.create_time DESC
LIMIT 1,1000;";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function addInfo($data)
    {
        $column = ['book_id', 'book_name', 'purchase_number', 'purchase_price', 'create_id', 'create_time'];
        $res = Yii::$app->db->createCommand()
            ->batchInsert('purchase', $column, $data)
            ->execute();
        return $res;
    }

}