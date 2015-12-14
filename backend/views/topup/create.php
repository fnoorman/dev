<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Topup */

$this->title = Yii::t('app', 'New Topup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['manage','topup'];
?>
<div class="topup-create">
    <div class="headline">
        <h2>Detail Topup Information</h2>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
