<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\RegistrationUnifyAsset;

RegistrationUnifyAsset::register($this);
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['signup'] ;
?>
<div class="site-signup">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

            <?php $form = ActiveForm::begin(['id' => 'form-signup','options'=>[
                'class'=>'reg-page',
            ]]); ?>

            <div class="reg-header">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Please fill out the following fields to signup:</p>
            </div>

                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'lastname') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
</div>
