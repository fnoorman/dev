<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\rbac\Item;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
//use common\assets\SkyFormUnifyAsset;
use common\assets\ProfileUnifyAsset;

ProfileUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */
/* @var $authModel common\models\AuthItemForm */


$typeText = $model->type == 1? 'Role':'Permission';
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',$typeText), 'url' => ['index','type'=>$model->type]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['authorization','role'];
//SkyFormUnifyAsset::register($this);
?>

<div class="tag-box tag-box-v3">
    <?php Pjax::begin();?>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="headline">
                        <h2> Detail <?=($model->type == 2? "Permission":"Role")  ?> Information</h2>
                        <!--                    <button class="btn-u btn-u-green pull-right" type="button" id="btn-close"><i class="fa fa-angle-double-right"></i></button>-->
                    </div>
                    <?= Html::a(Yii::t('app', 'Manage'), ['index','type'=>$model->type], ['class' => 'btn btn-info']) ?>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->name,'type'=>$model->type], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->name], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Action
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php if($model->type !== Item::TYPE_PERMISSION):?>
                                <li><a href="<?=Url::to(['authorization/view','id'=>$model->name,'type'=>Item::TYPE_ROLE,'actionType'=>Item::TYPE_ROLE])?>" id="assign-Role">Assign Role</a></li>
                            <?php endif;?>
                            <li><a href="<?=Url::to(['authorization/view','id'=>$model->name,'type'=>Item::TYPE_ROLE,'actionType'=>Item::TYPE_PERMISSION])?>" id="assign-Permission">Assign Permission</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <?= DetailView::widget([
                        'model' => $model,
                        'template'=>'<tr><th width="30%">{label}</th><td>{value}</td></tr>',
                        'options' => ['class'=> 'table table-striped'],
                        'attributes' => [
                            'name',
                            [
                                'attribute'=>'type',
                                'value'=>$model->typeText
                            ],
                            'description:ntext',
                            'rule_name',
                            'data:ntext',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animated bounceInRight" id="assign-section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="headline">
                        <h2> Assign <?=($authModel->actionType == 2? "Permission":"Role") ?></h2>
                    </div>
                    <div>
                        <?=Html::errorSummary($authModel)?>
                        <?=Html::beginForm(['authorization/assign'],'post',['class'=>'sky-form form-inline','style'=>'border:none'])?>
                        <section>
                            <label class="contorl-label">Select <?=($authModel->actionType == 2? "permission":"role")?> to assign to <?=$model->name?></label>
                            <label class="select">
                                <?=Html::activeDropDownList($authModel,'name',$authModel->getAvailableOptions(),['prompt'=>'Required to select'])?>

                                <i></i>
                            </label>
                            <?=Html::activeHiddenInput($authModel,'type',['value'=>$authModel->actionType])?>
                            <?=Html::activeHiddenInput($authModel,'parent',['value'=>$model->name])?>
                            <?=Html::activeHiddenInput($authModel,'parentType',['value'=>$model->type])?>

                            <?= Html::submitButton('Assign Now', ['class' => 'btn btn-success']) ?>

                        </section>
                        <?=Html::endForm()?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="headline">
                <h2>Ascendants</h2>
            </div>
            <?php if(count($ascendants) > 0):?>
                <?php foreach($ascendants as $ascendant):?>
                    <p>
                        <?=Html::a($ascendant['item']->name,['authorization/view','id'=>$ascendant['item']->name,'type'=>$ascendant['item']->type],['data-pjax'=>'0'])?>

                    </p>
                <?php endforeach;?>
            <?php endif;?>

        </div>
        <div class="col-lg-4">
            <div class="headline">
                <h2>Descendants</h2>
            </div>
            <?php if(count($descendants) > 0):?>
                <?php foreach($descendants as $descendant):?>
                    <p>
                        <?=Html::a($descendant['item']->name,['authorization/view','id'=>$descendant['item']->name,'type'=>$descendant['item']->type],['data-pjax'=>'0'])?>
                        <?php if($descendant['enable']):?>
                            <span class="pull-right">
                                <a
                                    href="<?=Url::to(['authorization/remove-child',
                                        'child'=>$descendant['item']->name,'parent'=>$model->name,
                                        'childType'=>$descendant['item']->type,'parentType'=>$model->type,
                                    ])?>"
                                    title="Delete" aria-label="Delete"
                                    data-confirm="Are you sure you want to delete this item?"
                                    data-method="post"
                                    data-pjax="0">
                                        <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </span>
                        <?php endif;?>
                    </p>
                <?php endforeach;?>

            <?php endif;?>
        </div>
        <div class="col-lg-4">
            <div class="headline">
                <h2>Permission</h2>

            </div>
            <?php foreach($permissions as $permission):?>
                <p>
                    <?=Html::a($permission['item']->name,['authorization/view','id'=>$permission['item']->name,'type'=>$permission['item']->type])?>
                    <?php if($permission['enable']):?>
                        <span class="pull-right">
                                <a href="<?=Url::to(['authorization/remove-child',
                                    'child'=>$permission['item']->name,'parent'=>$model->name,
                                    'childType'=>$permission['item']->type,'parentType'=>$model->type]
                                )?>"
                                   title="Delete" aria-label="Delete"
                                   data-confirm="Are you sure you want to delete this item?"
                                   data-method="post"
                                   >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </span>
                    <?php endif;?>
                </p>
            <?php endforeach;?>
        </div>
    </div>
    <?php Pjax::end();?>
</div>
<?php $this->beginBlock('JavascriptInit');?>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#assign-Role').click(function(){
                //alert('Clicked');
                $('#assign-actionName').text('Assign Role');
                $('#assign-section').toggle();
            })

            $('#assign-Role').click(function(){
                //alert('Clicked');
                $('#assign-actionName').text('Assign Permission');
                $('#assign-section').toggle();
            })


        });
    </script>
<?php $this->endBlock();?>
