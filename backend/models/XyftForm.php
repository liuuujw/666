<?php

namespace backend\models;

use yii;

class XyftForm extends Xyft
{

    public $stage;
    public $one;
    public $two;

    public function rules()
    {
        return [
            ['stage', 'required'],
            ['one', 'required'],
            ['two', 'required'],
        ];
    }

    public function addInfo()
    {
        $stage = date('Ymd') . sprintf("%04d", (int)$this->stage);
        $model = new Xyft();
        if ($this->findStage($stage)) {
            $model->stage = $stage;
            $model->one = $this->one;
            $model->two = $this->two;
            $model->kjtime = date('Y-m-d');
            $model->save();
            return true;
        }
        return false;
    }


    private function findStage($stage)
    {
        $model = new Xyft();
        $res = $model::find()
            ->where(['stage' => $stage])
            ->asArray()
            ->one();
        return empty($res);
    }


}