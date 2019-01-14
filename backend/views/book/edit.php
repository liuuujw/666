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
                    'id' => 'book-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'book_name', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '名称：', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '购书中心名称']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'book_number', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '编号：', 'class' => '']])->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '购书中心编号']);
                    ?>
                </div>
                <div class="row">
                    <div class="input-field col s12 field-code">
                        <label class="active" for="code">管理员：</label>
                    </div>
                    <?=
                    //                    $form->field($model, 'department_id', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '管理员：', 'class' => '']])->hiddenInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '管理员姓名']);
                    $form->field($model, 'department_id',
                        ['options' =>
                            [
                                'class' => 'input-field col s12'],
                                'labelOptions' => ['label' => '', 'class' => '']
                        ])
                        ->dropDownList(['1' => '大学', '2' => '高中', '3' => '初中'], ['prompt' => '请选择', 'class'=>'form-control', 'style' => 'width:120px']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'publisher_id', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '地址', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'specifications', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '电话', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'purchasing_cost', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'sell_price', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'wholesale_price', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'total', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'sale_number', ['options' => ['class' => 'input-field col s12'], 'labelOptions' => ['label' => '花费', 'class' => '']])->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '花费']);
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