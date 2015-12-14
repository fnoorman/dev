<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\rbac\Item;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItemForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin([
        'action'=>$model->isNewRecord ? ['authorization/create']:['authorization/update','id'=>$model->name,'type'=>$model->type]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if(intval($type) === Item::TYPE_PERMISSION):?>
        <?= $form->field($model, 'rule_name')->dropDownList($model->getAllRules(),['prompt'=>'Please select rule']) ?>
    <?php endif;?>
    <?php if(!$model->isNewRecord):?>
        <?= $form->field($model, 'oldName')->hiddenInput(['value'=>$model->name])->label(false) ?>
    <?php endif;?>

    <?= $form->field($model, 'type')->hiddenInput(['value'=>$type])->label(false) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 3]) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


