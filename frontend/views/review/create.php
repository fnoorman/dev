<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = Yii::t('app', 'Create Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-9">
    <div class="profile-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>


