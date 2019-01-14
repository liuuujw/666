<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>销售信息</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'sale-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'book_name', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '所售图书名称', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '书名']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'price', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '所售图书名称单价：', 'class' => '']])->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '单价']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'sold_number', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '所售图书名称数量：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '销售数量']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'total_price', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '所售图书总价：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '销售总价']);
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