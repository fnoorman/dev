<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\assets\ProfileUnifyAsset;
use common\assets\PricingUnifyAsset;
use common\widgets\Alert;

ProfileUnifyAsset::register($this);
PricingUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\CodeMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Code Members');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['hybrizy'];
?>

<div class="col-md-9">
    <div class="profile-body">
        <div class="headline">
            <h2>My Hybrizy Codes</h2>
        </div>

        <!--?php echo $this->render('_search', ['model' => $searchModel]); ?-->
        <?=$form?>


        <p>
            <?=Alert::widget()?>
            <!--?= Html::a(Yii::t('app', 'Create Code Member'), ['create'], ['class' => 'btn btn-success']) ?-->
        </p>

        <div class="row margin-bottom-40 pricing-medium-light">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
//                'itemView' => function ($model, $key, $index, $widget) {
//                    return Html::a(Html::encode($model->codeBank_code), ['view', 'id' => $model->id]);
//                },
            'itemView'=>'_item_view',
                'layout' => '<div class="row" style="padding-bottom: 20px"><div class="col-lg-12" style="margin-left: 20px">{summary}</div></div>'.'{items}<div class="row"><div class="col-lg-12">{pager}</div></div>',
            ]) ?>
        </div>

    </div>
</div>



