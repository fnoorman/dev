<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use backend\assets\PricingUnifyAsset;
//PricingUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Package */
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['active'] = ['manage','package'];

?>
<div class="row">
    <div class="col-lg-12">
        <div class="headline">
            <h2>Detail Package Information</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <?= DetailView::widget([
            'model' => $model,
            'template'=>'<tr><th width="200px">{label}</th><td>: {value}</td></tr>',
            'options'=>['class'=>'table table-striped'],
            'attributes' => [
                'id',
                'name',
                'maxCallOut',
                'maxAllowedCode',
                'enable',
                'code',
                'videoMaxSize',
                'pictureMaxSize',
                'minBalance',
                'contentSize'

            ],
        ]) ?>
        <div class="row">
            <div class="col-lg-12">
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
        </div>
    </div>
    <div class="col-lg-4">
        <?= DetailView::widget([
            'model' => $model,
            'template'=>'<tr><th width="150px">{label}</th><td>: {value}</td></tr>',
            'options'=>['class'=>'table table-striped'],
            'attributes' => [
                'updated_by',
                'updated_at:datetime',
                'created_by',
                'created_at:datetime',
                'duration',
                'expiredBy',
                'price',
                'position',
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
    <div class="col-lg-3" style="box-shadow: 0 0 15px #b5b5b5">
        <?=Yii::$app->controller->renderPartial('_template',['model'=>$model])?>
    </div>
</div>
<div class="row">

</div>
<!--<div class="package-view">-->
<!---->
<!---->
<!--</div>-->

