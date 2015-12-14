<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Topups');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['manage','topup'];
?>
<div class="topup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Topup'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'unitPrice',
            'maxCallOut',
            'updated_at',
            // 'created_at',
            // 'update_by',
            // 'created_by',
            // 'position',
            // 'enable',
            // 'price',
            // 'limitBy',
            // 'quota',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
