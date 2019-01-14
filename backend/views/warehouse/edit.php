<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>仓库信息</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'warehouse-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'number', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '编号：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '仓库编号']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'manager', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '管理员：', 'class' => '']])->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '管理员名称']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'phone', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '电话', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '联系电话']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'cost', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '运营成本', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '每月运营成本']);
                    ?>
                </div>
                <div class="row">
                    <button class="btn btn-primary">提交</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="clearBoth"></div>
        </div>
    </div>
</div>