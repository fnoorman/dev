<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

//$this->title = Yii::t('app', 'Update {modelClass}: ', [
//    'modelClass' => 'Video',
//]) . ' ' . $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="col-md-9">
    <div class="profile-body">
        <div class="row">
            <div class="col-md-9">
                <div class="headline">
                    <h2><?=$this->title?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="responsive-video md-margin-bottom-40" id="videoDisplay">
                    <iframe src="<?=$model->sdLink?>" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>

       </div>
    </div>
</div>




