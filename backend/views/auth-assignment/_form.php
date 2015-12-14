<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AuthAssignmentForm;
use common\assets\SkyFormUnifyAsset;

SkyFormUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'sky-form','style'=>'border:none']]); ?>
    <?=Html::errorSummary($model)?>
        <section>

            <label class="select".<?=$model->hasErrors('item_name')? " state-error":"" ?> >
                <?= $form->field($model,'item_name')->dropDownList($model->getRoleOptions(),['prompt'=>'Click to select role','class'=>'form-control'])?>

            </label>

            <label class="select">
               <?= $form->field($model,'user_id')->dropDownList($model->getUserOptions(),['prompt'=>'Click to select user']) ?>

            </label>
        </section>
        <?php if($model->scenario == AuthAssignmentForm::SCENARIO_UPDATE):?>
            <?=Html::activeHiddenInput($model,'_oldItemName',['value'=>$model->item_name])?>
        <?php endif;?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
