<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>出版商信息</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'publisher-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'publisher_name', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '名称：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '出版商名称']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'publisher_code', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '编号：', 'class' => '']])->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '出版商编号']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'publisher_phone', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '地址', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '出版商电话']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'publisher_address', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '地址', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '出版商地址']);
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