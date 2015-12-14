<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CodeBankCampaignSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="code-bank-campaign-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'codeBank_code') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'modelClass') ?>

    <?php // echo $form->field($model, 'objectId') ?>

    <?php // echo $form->field($model, 'startDate') ?>

    <?php // echo $form->field($model, 'endDate') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
