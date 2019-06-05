<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(!Yii::$app->session->getFlash('success')){
    echo '<div style="margin-top: 60px;"></div>';
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">


            <div class="card-content">
                <?php $form = ActiveForm::begin([
                    'id' => 'add-form',
                    'options' => ['class' => 'col s12'],
                ]) ?>

                <div class="row">
                    <?= $form->field($model, 'stage',['options'=>['class'=>'col-xs-4']])->textInput() ?>
                </div>
                <div class="row">
                    <?= $form->field($model, 'one',['options'=>['class'=>'col-xs-4']])->textInput() ?>
                </div>
                <div class="row">
                    <?= $form->field($model, 'two',['options'=>['class'=>'col-xs-4']])->textInput() ?>
                </div>
                <div class="row">
                    <h5 class="text-success"><?= Yii::$app->session->getFlash('success') ?? '' ?></h5>
                    <h5 class="text-danger"><?= Yii::$app->session->getFlash('error') ?? '' ?></h5>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <?= Html::submitButton('Ìí¼Ó', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>