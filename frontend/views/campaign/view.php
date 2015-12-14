<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\CodeBankCampaign */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Code Bank Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['campaign'];
?>
<div class="col-md-9">
    <div class="profile-body">


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
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'codeBank_code',
            'name',
            'modelClass',
            'objectId',
            'startDate:date',
            'endDate:date',
            'active',
        ],
    ]) ?>
    </div>
</div>
