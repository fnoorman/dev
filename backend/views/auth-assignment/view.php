<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */

$this->title = 'Role : '.$model->item_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-box tag-box-v3">
    <div class="row">
        <div class="col-lg-6">
            <div class="headline">
                <h2>Detail Role Assignment</h2>
            </div>
            <p>
                <?= Html::a(Yii::t('app', 'Manage'), ['index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <br>

            <?= DetailView::widget([
                'model' => $model,
                'options'=>['class'=>'table table-striped'],
                'template'=>'<tr><th width="30%">{label} </th><td>: {value}</td></tr>',
                'attributes' => [
                    'item_name',
                    'user_id',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>





</div>
