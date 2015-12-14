<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TopupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topup-search" style="display: none">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'unitPrice') ?>

    <?= $form->field($model, 'maxCallOut') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'limitBy') ?>

    <?php // echo $form->field($model, 'quota') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
