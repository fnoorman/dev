<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\CodeBankCampaign */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model,'codeBank_code')->dropDownList($codes,['prompt'=>'Please select Hybrizy Code'])?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?=$form->field($model,'modelClass')->dropDownList(Yii::$app->params['campaignOptions'],['prompt'=>'Please select Campaign Type'])?>

    <?= $form->field($model, 'objectId')->textInput() ?>

    <?=$form->field($model,'dateFrom')->widget(DateRangePicker::className(),[
        'attributeTo'=>'dateTo',
        'form'=>$form,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ])?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


