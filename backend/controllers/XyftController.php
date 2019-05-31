<?php

namespace backend\controllers;

use yii;
use backend\models\Xyft;

class XyftController extends yii\web\Controller
{

    public function actionIndex()
    {
        $res = Xyft::find()
            ->asArray()
            ->orderBy('stage')
            ->all();
        $count = count($res);
//        $stage = 1;
        $oneArray = [];
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) continue;
            if (!isset($res[$i]['one'])) {
                echo $i;
                continue;
            }
            $one = $res[$i - 1]['one'];
            $guess = implode(',', $this->getFiveRandNumber());
            $guessRes = (strpos($guess, $one)) ? '中' : '黑';
            $oneArray[] = $one;

            echo '前' . ($i - 1) . '期:&nbsp;&nbsp;&nbsp;&nbsp;';
            $chanceArray = array_count_values($oneArray);
            arsort($chanceArray);
            foreach ($chanceArray as $k => $v) {
                $str = $k . ':' . number_format($v / $i, 2) * 100 . '%;&nbsp;&nbsp;';
                if ($res[$i - 1]['one'] == $k) {
                    echo '<span style="color:#ff003c">' . $str . '</span>';
                } else {
                    echo $str;
                }
            }

//                echo '<br>'.($i+1).'期开奖:'.$one . ';&nbsp;&nbsp;' . $guess . ';&nbsp;&nbsp;' . $guessRes;
            echo '<br>' . ($i) . '期开奖:' . $one;
            echo '<br>';


        }
        die;
    }

    private function getFiveRandNumber(): array
    {
        $number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $return = [];
        $count = 9;
        for ($i = 0; $i < 5; $i++) {
            $key = rand(0, ($count - $i));
            $return[] = $number[$key];
            $number = $this->arrayRemove($number, $key);
        }
        sort($return);
        return $return;
    }

    private function arrayRemove(array $array, $key)
    {
        if (!is_array($array)) {
            return $array;
        }
        $newArray = [];
        unset($array[$key]);
        foreach ($array as $value) {
            $newArray[] = $value;
        }
        return $newArray;
    }

}