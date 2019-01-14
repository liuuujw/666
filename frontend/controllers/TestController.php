<?php

namespace frontend\controllers;

use yii;
use yii\base\Controller;
use yii\db\Command;

class TestController extends Controller
{

    public function actionIndex()
    {
        $redis = Yii::$app->redis;
        print_r($redis);
        exit;
    }

    public function actionCity()
    {
        $str = file_get_contents('./city.txt');
        $city_arr = json_decode($str, 1);
        $val_arr = [];
        foreach ($city_arr as $k => $v) {
            $val_arr[] = [$k, 1, $v['name'], date("Y-m-d H:i:s")];

            if (count($v['child']) > 0) {
                foreach ($v['child'] as $ck => $cv) {

                    $val_arr[] = [$ck, $k, $cv['name'], date("Y-m-d H:i:s")];
                    if (count($cv['child']) > 0) {
                        foreach ($cv['child'] as $dk => $dv) {

                            $val_arr[] = [$dk, $ck, $dv, date("Y-m-d H:i:s")];
                        }
                    }
                }
            }
        }
        $res = Yii::$app->db->createCommand()->batchInsert('city_china', ['id', 'pid', 'name', 'create_time'], $val_arr)->execute();
        print_r($res);
        echo '<br>';
        exit;
    }

    public function actionTest()
    {
        echo '<pre>';
        $query = new \yii\db\Query();
        $rows = $query->from('city_china')
            ->where(['pid' => 1])
            ->all();
        print_r($rows);
        exit;
    }

    public function actionTest1(){
        $str = '陈国俊 陈伟宏 陈育俊 刘烨 石凯平 练志伟 廖茂杰 刘升 曾凯 邹墨然 陈裕聪 王斌 刘康 刘世文 何胜明 郑志良 陈烨 曾静娴 陈清玲 罗丹婷 温思春 毛佳兴 陈科文 何雅威 罗凯华 李志宏 陈新科 陈嘉豪 刁浩明 石鑫 张朝威 张宇导 李志鹏 陈涛 辉哥 聪文 黄成伟 李永强 赖伟俊 饶宇葱 卢幸欣 赖林涛 李幸根 曾仁杰（待定） 陈伟阳（待定） 何超（待定） 王婷（待定） 吴锐昇（待定） 朱雄信（待定）';

        $arr = explode(' ',$str);
        print_r($arr);
    }

}
