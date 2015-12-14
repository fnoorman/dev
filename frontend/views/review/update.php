<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Review',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-md-9">
    <div class="profile-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>

