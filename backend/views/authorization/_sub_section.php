<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 10/10/15
 * Time: 12:03 PM
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="row">
    <div class="col-lg-4">
        <div class="headline">
            <h2>Ascendants</h2>
        </div>
        <?php if(count($ascendants) > 0):?>
            <?php foreach($ascendants as $ascendant):?>
                <p>
                    <?=Html::a($ascendant['item']->name,['authorization/view','id'=>$ascendant['item']->name,'type'=>$ascendant['item']->type])?>

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
                    <?=Html::a($descendant['item']->name,['authorization/view','id'=>$descendant['item']->name,'type'=>$descendant['item']->type])?>
                    <?php if($descendant['enable']):?>
                        <span class="pull-right">
                                <a
                                    href="<?=Url::to(['authorization/remove-child',
                                        'child'=>$descendant['item']->name,'parent'=>$model->name,
                                        'childType'=>$descendant['item']->name,'parentType'=>$model->name,
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
