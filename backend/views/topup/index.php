<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Topup');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['manage'] ;

?>
<div class="package-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="headline">
                <h2>All Top-up</h2>
            </div>
        </div>
    </div>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-lg-12">
            <p class="pull-right">
                <?= Html::a(Yii::t('app', 'Search'), '#', ['class' => 'btn btn-info','onclick'=>'$(".topup-search").toggle()']) ?>
                <?= Html::a(Yii::t('app', 'Create Topup'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>


    <!--?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
               'attribute'=> 'name',
                'headerOptions'=>['width'=>'150px']
            ],
            [
               'attribute'=> 'maxCallOut',
                'headerOptions'=>['width'=>'80px']
            ],
            [
                'label'=>'Codes',
               'attribute'=> 'maxAllowedCode',
                'headerOptions'=>['width'=>'80px']
            ],
            'enable',
            // 'code',
            // 'videoMaxSize',
            // 'pictureMaxSize',
            // 'minBalance',
            // 'updated_by',
            // 'updated_at',
            // 'created_by',
            // 'created_at',
            // 'duration',
            // 'expiredBy',
            // 'price',
            // 'position',
            // 'limitBy',
            // 'quota',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?-->

    <style>
        .package-summary
        {
            padding-bottom: 10px;
        }
    </style>
    <?=ListView::widget([
        'dataProvider'=>$dataProvider,
        'itemView'=>'_item_view',
        'layout' => '<div class="row" style="padding-bottom: 20px"><div class="col-lg-12">{summary}</div></div>'.'{items}<div class="row"><div class="col-lg-12">{pager}</div></div>',

    ])?>

</div>
