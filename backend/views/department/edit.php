<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>



<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>部门信息</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'department-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'name', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '名称：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '购书中心名称']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'code', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '编号：', 'class' => '']])->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '购书中心编号']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'manager', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '管理员：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '管理员姓名']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'address', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '地址', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div><div class="row">
                    <?=
                    $form->field($model, 'phone', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '电话', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div><div class="row">
                    <?=
                    $form->field($model, 'month_cost', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
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