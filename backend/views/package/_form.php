<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Package */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maxCallOut')->textInput() ?>

    <?= $form->field($model, 'maxAllowedCode')->textInput() ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'videoMaxSize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pictureMaxSize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minBalance')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'expiredBy')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'limitBy')->textInput() ?>

    <?= $form->field($model, 'quota')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
