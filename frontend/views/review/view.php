<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
    <div class="profile-body padding-10">

        <div class="row">
            <div class="col-md-12 box-shadow shadow-effect-1">
                <div class="headline">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>


                <div class="row">
                    <div class="col-md-12 box-shadow shadow-effect-1">
                        <?= DetailView::widget([
                            'model' => $model,
                            'template'=>"<tr><th width='150px'>{label}</th><td>{value}</td></tr>",
                            'options'=>['class'=>'table table-striped'],
                            'attributes' => [
//            'id',
                                'contents:html',
                                'title',
                                'created_at:datetime',
                                'updated_at:datetime',
                                'userName',
                                'lastUpdatedBy',
                            ],
                        ]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 box-shadow shadow-effect-1 ">
                        <p class="pull-right">
                            <?= Html::a(Yii::t('app', 'Manage'), ['index'], ['class' => 'btn btn-info']) ?>
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
        </div>


    </div>
</div>
