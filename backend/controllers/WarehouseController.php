<?php

namespace backend\controllers;

use backend\models\BookCenter;
use backend\models\Staff;
use common\models\Common;
use yii;
use backend\models\Warehouse;

class WarehouseController extends BaseController
{

    public $m_name = '仓库管理';

    public function actionIndex()
    {
        $this->getModelName($this->m_name);
        $model = new Warehouse();
        $data = $model->getList();
        return $this->render('list', ['data' => $data]);
    }

    public function actionEdit()
    {
        $type = Yii::$app->request->get('t') == 'add' ? '添加' : '编辑';
        $this->getModelName($this->m_name, $type);
        $model = new Warehouse();
        return $this->render('edit', ['model' => $model]);
    }

}