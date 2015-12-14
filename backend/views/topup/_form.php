<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Topup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topup-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'unitPrice')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'maxCallOut')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'position')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'enable')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'limitBy')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'quota')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
