<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
$title = 'New user role assignment';
$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authorization Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-box tag-box-v3">
    <div class="row">
        <div class="col-lg-6">
            <div class="headline">
                <h2><?= Html::encode($this->title) ?></h2>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
