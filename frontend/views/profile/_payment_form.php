<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */

if($model->scenario == 'checkout')
    $action = ['checkout'];
else
    $action = !isset($model->user_id)? ['payment-create']:['payment-update']
?>
    <?php $form = ActiveForm::begin([
        'id'=>'order-form',
        'layout'=>'horizontal',
        'action'=> $action
    ]); ?>
    <?php if($model->scenario !== 'checkout'):?>
        <div class="headline">
            <h2>Profile Information</h2>
        </div>

        <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label('First Name') ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label('Last name') ?>



        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label('Mobile/Telephone') ?>

        <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
    <?php endif;?>
    <div class="headline">
        <h2>Billing Information</h2>
    </div>
    <?= $form->field($model, 'payment_firstname')->textInput(['maxlength' => true])->label('First Name') ?>

    <?= $form->field($model, 'payment_lastname')->textInput(['maxlength' => true])->label('Last Name') ?>

    <?php if($model->scenario == 'checkout'):?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label('Mobile/Telephone') ?>

    <?php endif;?>

    <?= $form->field($model, 'payment_company')->textInput(['maxlength' => true])->label('Company Name') ?>

    <?= $form->field($model, 'payment_address_1')->textInput(['maxlength' => true])->label('Address 1') ?>

    <?= $form->field($model, 'payment_address_2')->textInput(['maxlength' => true])->label('Address 2') ?>

    <?= $form->field($model, 'payment_city')->textInput(['maxlength' => true])->label('City') ?>

    <?= $form->field($model, 'payment_postcode')->textInput(['maxlength' => true])->label('Zip Code ') ?>

    <?= $form->field($model, 'payment_country')->textInput(['readonly'=>'true','maxlength' => true,'value'=>'Malaysia'])->label('Country') ?>


    <?php if($model->scenario !== 'checkout'):?>
        <div class="headline">
            <h2>Shipping Information</h2>
        </div>

        <?= $form->field($model, 'shipping_firstname')->textInput(['maxlength' => true])->label('First Name') ?>

        <?= $form->field($model, 'shipping_lastname')->textInput(['maxlength' => true])->label('Last Name')?>

        <?= $form->field($model, 'shipping_company')->textInput(['maxlength' => true])->label('Company Name') ?>

        <?= $form->field($model, 'shipping_address_1')->textInput(['maxlength' => true])->label('Address 1') ?>

        <?= $form->field($model, 'shipping_address_2')->textInput(['maxlength' => true])->label('Address 2') ?>

        <?= $form->field($model, 'shipping_city')->textInput(['maxlength' => true])->label('City') ?>

        <?= $form->field($model, 'shipping_postcode')->textInput(['maxlength' => true])->label('Zip Code') ?>

        <?= $form->field($model, 'shipping_country')->textInput(['maxlength' => true])->label('Country') ?>


        <button type="reset" class="btn-u btn-u-default">Cancel</button>
        <button type="submit" class="btn-u" id="btnSaveChanges">Save Changes</button>
    <?php endif;?>
    <?php if($model->scenario === 'checkout'):?>
        <button type="submit" class="btn-u hidden" id="btnSaveChanges">Save Changes</button>
    <?php endif;?>

    <?php ActiveForm::end(); ?>


