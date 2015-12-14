<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-9">
    <div class="profile-body">
        <h1><?= Html::encode($this->title) ?></h1>


        <p>
            <?= Html::a(Yii::t('app', 'Create Review'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
            },
        ]) ?>
    </div>
</div>



