<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = Yii::t('app', 'Create Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-9">
    <div class="profile-body">

        <?php $form = ActiveForm::begin([
            'id'=>'form-review-upload',
            'action'=>Url::to(['/review/confirmed']),
            'options'=>['class'=>'sky-form','role'=>'form']
        ])?>
        <?=$form->field($codeBankCampaign,'codeBank_code')->hiddenInput()->label(false)?>
        <?=$form->field($codeBankCampaign,'name')->hiddenInput()->label(false)?>
        <?=$form->field($codeBankCampaign,'modelClass')->hiddenInput()->label(false)?>
        <?=$form->field($codeBankCampaign,'startDate')->hiddenInput()->label(false)?>
        <?=$form->field($codeBankCampaign,'endDate')->hiddenInput()->label(false)?>
        <header>
            <i class="fa fa-pencil-square-o"></i>

            <?= $model->scenario === 'campaign'? 'New': ucfirst(Yii::$app->controller->action->id)?> Campaign: Review
        </header>

        <fieldset>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'contents')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions'=>['buttons'=>['format', 'bold', 'italic', 'deleted',
                'lists', 'image', 'horizontalrule','indent','outdent','alignment','orderedlist','unorderedlist']]]) ?>
        </fieldset>


        <footer>
            <div class="form-group">
                <?= Html::submitButton('Add Review', ['class' =>'btn btn-primary','id'=>'btn-review']) ?>
            </div>
        </footer>


        <?php ActiveForm::end()?>

    </div>
</div>


