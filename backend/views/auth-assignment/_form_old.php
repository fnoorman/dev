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

    <?=Html::beginForm(['auth-assignment/create'],'post',['class'=>'sky-form','style'=>'border:none'])?>

        <section>
            <?=Html::activeLabel($model,'item_name')?>
            <label class="select">
                <?=Html::activeDropDownList($model,'item_name',$model->getRoleOptions(),['prompt'=>'Required to select Role'])?>
                <i></i>
            </label>
        </section>
        <section>
            <?=Html::activeLabel($model,'user_id')?>
            <label class="select">
                <?=Html::activeDropDownList($model,'user_id',$model->getUserOptions(),['prompt'=>'Required to select User'])?>
                <i></i>
            </label>
        </section>



    <?php if($model->scenario == AuthAssignmentForm::SCENARIO_UPDATE):?>
        <?=Html::activeHiddenInput($model,'_oldItemName',['value'=>$model->item_name])?>
    <?php endif;?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?=Html::endForm(); ?>

</div>
