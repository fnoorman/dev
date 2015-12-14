<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Videos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
    <div class="profile-body">
        <h1><?= Html::encode($this->title) ?></h1>
        <!--?php echo $this->render('_search', ['model' => $searchModel]); ?-->

        <p>
            <?= Html::a(Yii::t('app', 'Create Video'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            },
        ]) ?>
    </div>



</div>
