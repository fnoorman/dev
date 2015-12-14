<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Topup */

$this->title =  $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['active']=['manage','update'] ;
?>
<div class="topup-update">
    <div class="headline">
        <h2>Editing Detail information</h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
