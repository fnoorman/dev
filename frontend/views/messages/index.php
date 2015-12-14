<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel common\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Messages');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['messages']
?>
<style>
     .media.media-v2 {
        margin-top: 0;
        padding: 25px 0 20px;
        border-bottom: 1px solid #eee;
    }

    .panel-body .item:last-child {
        background-color: red;
    }
</style>
<div class="col-md-9">
    <div class="profile-body">
        <div class="panel-heading overflow-h">
            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-inbox"></i>User Messages</h2>
            <a href="#"><i class="fa fa-cog pull-right"></i></a>

        </div>
        <div class="panel-body margin-bottom-50" style="background-color: white">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
//            'itemView' => function ($model, $key, $index, $widget) {
//                return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
//            },
                'itemView'=>'_message_item',
                'layout' => '</div>'.'{items}<div class="row"><div class="col-lg-12">{pager}</div></div>',
            ]) ?>
        </div>

    </div>
</div>





