<?php

namespace backend\controllers;

use backend\models\Charts;

class ChartsController extends BaseController
{

    public $m_name = '报表';
    public $start_year = 2013;

    public function actionIndex()
    {

        return $this->render('index');
    }

    //各中心年利润
    public function actionCenterannualprofit()
    {
        $profit_res = Charts::getCenterAnnualProfit();
        if (!empty($profit_res)) {
            return json_encode($profit_res, JSON_UNESCAPED_UNICODE);
        }
        return false;
    }

    //各中心年发放工资总数
    public function actionTotalwages()
    {
        $wages_res = Charts::getCenterTotalWages();
        if (!empty($wages_res)) {
            return json_encode($wages_res, JSON_UNESCAPED_UNICODE);
        }
        return false;
    }

    //销售总量
    public function actionSoldtotal()
    {
        $sold_res = Charts::getSoldTotal();
        if (!empty($sold_res)) {
            return json_encode($sold_res, JSON_UNESCAPED_UNICODE);
        }
        return false;
    }


    //利润报表
    public function actionProfit()
    {
        $this->getModelName($this->m_name,'月利润');
        $time=['year'=>date('Y'),'month'=>date('m')];
        return $this->render('profit',[
            'time'=>$time,
        ]);
    }

    //ajax获取利润报表
    public function actionAjaxprofit()
    {
        $data = Charts::centerMonthProfit();
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }


    public function actionSold(){
        $this->getModelName($this->m_name,'销量');
        return $this->render('sold');
    }

    public function actionAjaxsoldtotal(){
        $data = Charts::soldTotalNumber();
        return json_encode($data);
    }

    public function actionAjaxsoldprice(){
        $data = Charts::soldTotalPrice();
        return json_encode($data);
    }


    public function actionWages(){
        $this->getModelName($this->m_name,'月工资');
        return $this->render('wages');
    }

        public function actionAjaxwagestotal(){
        $data = Charts::wagesTotal();
        return json_encode($data);
    }

    public function actionPurchase(){
        $this->getModelName($this->m_name,'进货量');
        return $this->render('purchase');
    }

    public function actionAjaxpurchasetotal(){
        $data = Charts::purchaseTotal();
        return json_encode($data);
    }

    public function actionWarehouse(){
        $this->getModelName($this->m_name,'库存量');
        return $this->render('warehouse');
    }

    public function actionOperate(){
        $this->getModelName($this->m_name,'月运营');
        return $this->render('operate');
    }

    public function actionAjaxoperate(){
        $data = Charts::operateTotal();
        return json_encode($data);
    }
}