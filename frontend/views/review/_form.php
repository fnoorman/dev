<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'sky-form','role'=>'form']
    ]); ?>
    <header>
        <i class="fa fa-pencil-square-o"></i>
        <?=ucfirst(Yii::$app->controller->action->id)?> Campaign: Review
    </header>
    <fieldset>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <!--?= $form->field($model, 'contents')->widget(\yii\redactor\widgets\Redactor::className()) ?-->
        <?= $form->field($model, 'contents')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions'=>['buttons'=>['format', 'bold', 'italic', 'deleted',
            'lists', 'image', 'horizontalrule','indent','outdent','alignment','orderedlist','unorderedlist']]]) ?>

    </fieldset>
    <footer>
        <div class="form-group">
            <?= Html::a('Manage',['/review/index'], ['class' => 'btn btn-info','style'=>'color:white']) ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php if(!$model->isNewRecord):?>
            <?=Html::a(' &nbsp Back  &nbsp',['/review/view','id'=>$model->id],['class'=>['btn btn-info']])?>
            <?php endif;?>
        </div>
    </footer>


    <?php ActiveForm::end(); ?>


