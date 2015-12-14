<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\assets\ProfileUnifyAsset;
use frontend\assets\MasonryUnifyAsset;


ProfileUnifyAsset::register($this);
MasonryUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\CodeBankCampaignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Campaigns');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['campaign'];
?>
<div class="col-md-9">
    <div class="profile-body ">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>

                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

                <p class="pull-right">
                    <?= Html::a(Yii::t('app', Html::tag('i','',['class'=>'fa fa-bullhorn']).'  New Campaign'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
        </div>


        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'col-md-6 grid-boxes-in masonry-brick shadow-wrapper'],
                'itemView' => '_item_view'
//            'itemView' => function ($model, $key, $index, $widget) {
//                return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
//            },
            ]) ?>

        </div>





    </div>
</div>

<?php $this->beginBlock('JavascriptInit');?>
<script type="text/javascript">
    $('video').ready().removeAttr('autoplay');

</script>

<?php $this->endBlock();?>



