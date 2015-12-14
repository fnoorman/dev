<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-search" style="display: none;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'maxCallOut') ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'maxAllowedCode') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'enable') ?>
        </div>
        <div class="col-lg-4">
            <?php echo $form->field($model, 'code') ?>
        </div>
        <div class="col-lg-4">
            <?php  echo $form->field($model, 'expiredBy') ?>
        </div>
    </div>










    <?php // echo $form->field($model, 'videoMaxSize') ?>

    <?php // echo $form->field($model, 'pictureMaxSize') ?>

    <?php // echo $form->field($model, 'minBalance') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'duration') ?>



    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'limitBy') ?>

    <?php // echo $form->field($model, 'quota') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
