<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Authorization');
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=$searchModel->type == 2? ['authorization','permission']:['authorization','role'];
?>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><!--?//= Html::a(Yii::t('app', 'Create Auth Item'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<div class="tag-box tag-box-v3">
    <div class="row">
        <div class="col-lg-<?=isset($searchModel->type)? 8:12?>" id="authorization-section">
            <div class="headline">
                <?php if(!isset($searchModel->type)):?>
                    <h1><?=$this->title?> by Role and Permission</h1>
                <?php else:?>
                    <h1> <?=$this->title . ' by '. ($searchModel->type == 2? "Permission":"Role") ?></h1>
                <?php endif;?>
                <button class="btn btn-success pull-right" type="button" id="btn-new"><i class="fa fa-plus"></i> New <?=($searchModel->type == 2? "Permission":"Role")?></button>
            </div>

            <?= GridView::widget([
                'tableOptions'=>['class'=>'table table-striped', 'id'=>'authorization-table'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons'=> [
                            'view' => function ($url, $model, $key) {
                                $url = Url::to(['authorization/view','id'=>$model->name,'type'=>$model->type,'actionType'=>$model->type]);
                                $icon = Html::tag('span','',['class'=>'glyphicon glyphicon-eye-open']);
                                return Html::a($icon, $url,['title'=>'View','aria-label'=>'View','data-pjax'=>0]);
                            },
                            'update' => function ($url, $model, $key) {
                                $url = Url::to(['authorization/update','id'=>$model->name,'type'=>$model->type]);
                                $icon = Html::tag('span','',['class'=>'glyphicon glyphicon-pencil']);
                                return Html::a($icon, $url,['title'=>'Update','aria-label'=>'Update','data-pjax'=>0]);
                            },
                            'delete' => function ($url, $model, $key) {
                                $url = Url::to(['authorization/delete','id'=>$model->name,'type'=>$model->type]);
                                $icon = Html::tag('span','',['class'=>'glyphicon glyphicon-trash']);
                                return Html::a($icon, $url,['title'=>'Delete','aria-label'=>'Delete','data-pjax'=>0,'data-method'=>'post','data-confirm'=>'Are you sure you want to delete this item ?']);
                            }
                        ],
                        'headerOptions'=>['width'=>'80px'],
                    ],
                    [
                        'attribute' => 'name',
                        'headerOptions'=>['width'=>'150px'],
                    ],
                    'description:ntext',
                    [
                        'attribute' => 'rule_name',
                        'headerOptions'=>['id'=>'rule_header','class'=>'animated bounceInRight'],
                        'contentOptions' =>['id'=>'rule_content','class'=>'animated bounceInRight']
                    ],
                    [
                        'attribute' => 'data',
                        'format'=> 'ntext',
                        'headerOptions'=>['id'=>'rule_header','class'=>'animated bounceInRight'],
                        'contentOptions' =>['id'=>'rule_content','class'=>'animated bounceInRight']
                    ],
//                    'data:ntext'

                ],
            ]); ?>
        </div>
        <?php if(isset($searchModel->type)):?>
            <div class="col-lg-4 animated bounceInRight">
                <div class="headline">
                    <h1> <?=($AuthItemForm->isNewRecord ? "New": "Update").' '. ($searchModel->type == 2? "Permission":"Role") ?></h1>
                    <button class="btn-u btn-u-green pull-right" type="button" id="btn-close"><i class="fa fa-angle-double-right"></i></button>
                </div>
                <div class="auth-item-form">
                    <?=Yii::$app->controller->renderPartial('_form',['model'=>$AuthItemForm,'type'=>$searchModel->type])?>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>

<?php $this->beginBlock('JavascriptInit');?>
<script type="text/javascript">


    $('td:nth-child(5),th:nth-child(5)').ready().toggle();
    $('td:nth-child(6),th:nth-child(6)').ready().toggle();
    $('#btn-new').ready().toggle();

    $(document).ready(function(){


        $('#btn-close').click(function(){
//            alert("OK");
            $('.col-lg-4.animated.bounceInRight').toggle();
            $('#authorization-section').attr('class','col-lg-12');
            $('td:nth-child(5),th:nth-child(5)').toggle();
            $('td:nth-child(6),th:nth-child(6)').toggle();
            $('#btn-new').toggle();


//            $.ajax({
//                url:'/api/default/grid-view?type='+$('#authitemform-type').val()+'&visible=true',
//            }).done(function(html){
//                $('.grid-view').replaceWith(html);
//            });

        });

        $('#btn-new').click(function(){
            $('#btn-new').toggle();
            $('#authorization-section').attr('class','col-lg-8');
            $('td:nth-child(5),th:nth-child(5)').toggle();
            $('td:nth-child(6),th:nth-child(6)').toggle();
            $('.col-lg-4.animated.bounceInRight').toggle();
        });
    });

</script>
<?php $this->endBlock();?>




