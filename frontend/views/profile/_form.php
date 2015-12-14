<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_company_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_address_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_address_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_country_id')->textInput() ?>

    <?= $form->field($model, 'shipping_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_address_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_address_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_country_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


