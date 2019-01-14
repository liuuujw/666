<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>添加工资记录</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'wages-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'staff_name', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '员工姓名：', 'class' => '']])->textInput(['id' => 'staff_name', 'class' => 'validate', 'placeholder' => '员工姓名']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'money', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '工资(￥)：', 'class' => '']])->textInput(['id' => 'money', 'class' => 'validate', 'placeholder' => '工资金额']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'time', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '时间：', 'class' => '']])->textInput(['id' => 'money', 'class' => 'validate', 'placeholder' => '发工资时间']);
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