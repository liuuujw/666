<?php

namespace backend\models;

use yii;
use yii\base\Model;

class Charts extends Model
{

    public static function getCenterAnnualProfit()
    {
        $sql = "SELECT 
sr.center_info_id,
ci.name,
CAST((SUM(sr.total_price) - SUM(b.purchasing_price * sr.sold_number)) AS DECIMAL(14,2)) AS lirun
FROM sold_record AS sr
LEFT JOIN book AS b
ON sr.book_id=b.id
LEFT JOIN center_info AS ci
ON sr.center_info_id=ci.id
WHERE sr.is_valid=1
AND b.is_valid=1
AND ci.is_valid=1
GROUP BY center_info_id;";
        return self::returnResult($sql);
    }


    public static function getCenterTotalWages()
    {
        $sql = "SELECT 
ci.id AS center_info_id,
SUBSTRING(ci.name,1,2) AS center_info_name,
CAST(SUM(wr.should_pay) AS DECIMAL(14,2)) AS total_wages
FROM wages_record AS wr
LEFT JOIN staff AS s
ON wr.staff_id = s.id
LEFT JOIN center_info AS ci
ON s.center_info_id=ci.id
WHERE wr.is_valid=1
AND s.is_valid=1
AND ci.is_valid=1
GROUP BY center_info_id;";
        return self::returnResult($sql);
    }

    public static function getSoldTotal()
    {
        $sql = "
SELECT 
sr.center_info_id,
SUBSTRING(ci.name,1,2) AS center_info_name,
SUM(sr.sold_number) AS sold_total
FROM sold_record AS sr
LEFT JOIN center_info AS ci
ON sr.center_info_id = ci.id
WHERE sr.center_info_id < 13
AND sr.is_valid=1
AND ci.is_valid=1
GROUP BY sr.center_info_id
 ;";
        return self::returnResult($sql);
    }


    public static function centerMonthProfit($startTime = '', $endTime = '')
    {
        $sql = "SELECT
sr.`center_info_id`,
SUBSTRING(ci.name,1,2) AS center_info_name,
CAST(SUM(sr.`total_price`-(b.`purchasing_price`*sr.sold_number)) AS DECIMAL(14,2)) AS `profit`,
CONCAT(DATE_FORMAT(sr.`create_time`,'%Y'),DATE_FORMAT(sr.`create_time`,'%m')) AS `time`
FROM sold_record AS sr
LEFT JOIN book AS b
ON sr.`book_id`=b.`id`
LEFT JOIN center_info as ci 
ON sr.`center_info_id`=ci.`id`
WHERE sr.`is_valid`=1
AND b.`is_valid`=1
and ci.`is_valid`=1
";
        if ($startTime == '' && $endTime == '') {
            $sql .= "GROUP BY `time`, sr.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;";
        } else {
            $sql .= " AND `create_time` between '" . $startTime . "' and '" . $endTime . "'
            GROUP BY sr.`center_info_id`;";
        }

        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }


    //各区每月销量
    public static function soldTotalNumber()
    {
        $sql = "SELECT
SUBSTRING(ci.name,1,2) AS center_info_name,
SUM(sold_number) AS `total_number`,
CONCAT(DATE_FORMAT(sr.`create_time`,'%Y'),DATE_FORMAT(sr.`create_time`,'%m')) AS `time`
FROM sold_record AS sr
LEFT JOIN center_info AS ci
ON sr.`center_info_id`=ci.`id`
WHERE sr.`is_valid`=1
AND ci.`is_valid`=1
GROUP BY `time`,sr.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;";
        return self::returnResult($sql);
    }

    public static function soldTotalPrice()
    {
        $sql = "SELECT
SUBSTRING(ci.name,1,2) AS center_info_name,
SUM(sold_price) AS `total_price`,
CONCAT(DATE_FORMAT(sr.`create_time`,'%Y'),DATE_FORMAT(sr.`create_time`,'%m')) AS `time`
FROM sold_record AS sr
LEFT JOIN center_info AS ci
ON sr.`center_info_id`=ci.`id`
WHERE sr.`is_valid`=1
AND ci.`is_valid`=1
GROUP BY `time`,sr.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;
";
        return self::returnResult($sql);
    }

    public static function wagesTotal(){
        $sql = "SELECT
SUBSTRING(ci.name,1,2) AS center_info_name,
CAST(SUM(should_pay) AS DECIMAL(14,2)) AS `total_price`,
CONCAT(DATE_FORMAT(wr.`create_time`,'%Y'),DATE_FORMAT(wr.`create_time`,'%m')) AS `time`
FROM wages_record AS wr
LEFT JOIN staff AS s
ON wr.`staff_id`=s.`id`
LEFT JOIN center_info AS ci
ON s.`center_info_id` = ci.`id`
WHERE wr.`is_valid`=1
AND s.`is_valid`=1
AND ci.`is_valid`=1
GROUP BY `time`,s.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;";
        return self::returnResult($sql);
    }

    public static function purchaseTotal(){
        $sql = "SELECT
SUBSTRING(ci.name,1,2) AS center_info_name,
SUM(p.`purchase_number`) AS `total_purchase`,
CONCAT(DATE_FORMAT(p.`create_time`,'%Y'),DATE_FORMAT(p.`create_time`,'%m')) AS `time`
FROM purchase AS p
LEFT JOIN center_info AS ci
ON p.`center_info_id`=ci.`id`
WHERE p.`is_valid`=1
AND ci.`is_valid`=1
GROUP BY `time`,p.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;";
        return self::returnResult($sql);
    }


    public static function operateTotal(){
        $sql = "SELECT
SUBSTRING(ci.name,1,2) AS center_info_name,
SUM(d.`per_month_cost`) AS `department_total_cost`,
CONCAT(DATE_FORMAT(d.`create_time`,'%Y'),DATE_FORMAT(d.`create_time`,'%m')) AS `time`
FROM department AS d
LEFT JOIN center_info AS ci
ON d.`center_info_id`=ci.`id`
WHERE d.`is_valid`=1
AND ci.`is_valid`=1
GROUP BY `time`,d.`center_info_id`
ORDER BY `time` DESC
LIMIT 0,12;
";
        return self::returnResult($sql);
    }

    public static function returnResult($sql)
    {
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        return $res;
    }

}