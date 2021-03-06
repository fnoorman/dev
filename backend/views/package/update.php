<?php

use yii\helpers\Html;
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Package */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Package',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['active']=['manage','package'] ;
?>
<div class="package-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
