<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Field;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'price',
                    'product_type',
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by',
                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <h1>Fields</h1>
            <?php $form = ActiveForm::begin();?>
                <?= $form->field($productField, 'field_id')->dropDownList(
                    ArrayHelper::map(Field::find()->all(), 'id', 'name')
                , ['prompt'=>'Please select Field']) ?>
                <?= $form->field($productField, 'product_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
                <?= $form->field($productField,'value')->textInput()?>
                <?= $form->field($productField,'rules')->textarea(['row'=>'3'])?>

            <div class="form-group">
                <?= Html::submitButton($productField->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end();?>
        </div>
    </div>






</div>
