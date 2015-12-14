<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title = 'Role assignment to user';

$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-box tag-box-v3">
    <div class="row">
        <div class="col-lg-12">
            <div class="headline">

                <h2><?= Html::encode($this->title) ?></h2>


            </div>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= Html::a(Yii::t('app', 'New role assignment'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions'=>['class'=>'table table-striped', 'id'=>'authorization-table'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'item_name',
                    'user_id',
                    'created_at:datetime',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>






