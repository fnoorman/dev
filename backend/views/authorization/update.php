<?php

use yii\helpers\Html;
use common\models\Lookup;
/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */

//$this->title = 'Update '. $model->TypeName(). ': '. $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authorization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tag-box tag-box-v3">
    <div class="row">
        <div class="col-lg-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
