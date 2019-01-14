<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-action">
                <h2>添加员工信息</h2>
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'staff-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>
                <div class="row">
                    <?=
                    $form->field($model, 'code',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '员工编号：', 'class' => '']
                        ]
                    )->textInput(['id' => 'code', 'class' => 'validate', 'placeholder' => '编号']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'name',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '员工姓名：', 'class' => '']
                        ]
                    )->textInput(['id' => 'name', 'class' => 'validate', 'placeholder' => '姓名']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'department_id',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '所属部门：', 'class' => '']
                        ]
                    )->textInput(['id' => 'department_id', 'class' => 'validate', 'placeholder' => '部门']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'age',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '年龄：', 'class' => '']
                        ]
                    )->textInput(['id' => 'age', 'class' => 'validate', 'placeholder' => '年龄']);
                    ?>
                </div>
                <div class="row">
                    <div class="input-field col s12 field-gender">
                        <label class="active" for="gender">性别：</label>
<!--                        <input type="text" id="gender" class="validate" name="Staff[gender]" placeholder="性别">-->
                        <p>
                            <input name="group1" type="radio" id="test1" value="0">
                            <label for="test1">女</label>
                        </p>
                        <p>
                            <input name="group1" type="radio" id="test2" value="1">
                            <label for="test2">男</label>
                        </p>
                        <div class="help-block"></div>
                    </div>                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'title',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '员工职称：', 'class' => '']
                        ]
                    )->textInput(['id' => 'title', 'class' => 'validate', 'placeholder' => '职称']);
                    ?>
                </div>
                <div class="row">
                    <?=
                    $form->field($model, 'wage',
                        [
                            'options' => ['class' => 'input-field col s12'],
                            'labelOptions' => ['label' => '员工月工资(￥)：', 'class' => '']
                        ]
                    )->textInput(['id' => 'wage', 'class' => 'validate', 'placeholder' => '工资']);
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