<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\assets\ProfileUnifyAsset;
ProfileUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\CodeMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Code Members');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['group'];
?>
<div class="col-md-9">
    <div class="profile-body">

        <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <!--?= //Html::a(Yii::t('app', 'Create Code Member'), ['create'], ['class' => 'btn btn-success']) ?-->
        </p>

        <div class="panel panel-profile">
            <div class="panel-heading overflow-h">
                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-users"></i>Code Members : <b style="color: orange"><?=$searchModel->codeBank_code?></b></h2>
<!--                <a href="page_profile_users.html" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right">View All</a>-->
            </div>
            <div class="panel-body">
                <div class="row">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'col-sm-6'],
                        'layout' => '<div class="row" style="padding-bottom: 20px"><div class="col-lg-12" style="margin-left: 20px">{summary}</div></div>'.'{items}<div class="row"><div class="col-lg-12">{pager}</div></div>',
                        'itemView' => '_item_view',
                    ]) ?>
                </div>
            </div>
        </div>


    </div>
</div>




