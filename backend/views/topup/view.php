<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Topup */

$this->title = 'Name: '. $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['active']=['manage','topup'];
?>
<div class="topup-view">

    <div class="row">
        <div class="col-lg-12">
            <div class="headline">
                <h2>Detail Top-up Information</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'options'=>['class'=>'table table-striped'],
                'attributes' => [
                    'id',
                    'name',
                    'unitPrice',
                    'maxCallOut',
                    'updated_at:datetime',
                    'created_at:datetime',
                    'update_by',

                ],
            ]) ?>
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
        </div>
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'options'=>['class'=>'table table-striped'],
                'attributes' => [

                    'created_by',
                    'position',
                    'enable',
                    'price',
                    'limitBy',
                    'quota',
                ],
            ]) ?>
        </div>
        <style>
            .price-active, .pricing:hover {
                margin-top: 0px;
                box-shadow: none;
            }


        </style>
        <div class="col-lg-3" style="box-shadow: 0 0 15px #b5b5b5;padding-top: 15px">
            <?=Yii::$app->controller->renderPartial('_template',['model'=>$model,'backgroundColor'=>'#29abe2'])?>
        </div>
    </div>





</div>
