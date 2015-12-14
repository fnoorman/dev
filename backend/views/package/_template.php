<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/17/15
 * Time: 11:18 AM
 */
/* @var $model common\models\Package */
use yii\helpers\Url;
?>

<div class="pricing hover-effect pricing-dark">
    <div class="pricing-head">
        <h3><?=$model->name?></h3>
    </div>
    <ul class="pricing-content list-unstyled" style="background-color: #17607f">

        <li><i class="fa fa-gift"></i> Campaign customization <span><i class="fa fa-check pull-right"></i></span></li>
        <li><i class="fa fa-inbox"></i> 24 hour support<span><i class="fa fa-check pull-right"></i></span></li>
        <li><i class="fa fa-globe"></i> <?=$model->contentSize?> MB Content Space<i class="fa fa-check pull-right"></i></li>
        <li><i class="fa fa-video-camera"></i> <?=$model->videoMaxSize?> MB Video Storage<i class="fa fa-check pull-right"></i></li>
        <li><i class="fa fa-mail-forward"></i> <?=$model->maxCallOut?> Call-Outs<i class="fa fa-check pull-right"></i></li>
        <li><i class="fa fa-code"></i> <?=$model->maxAllowedCode?> Hybrizy Code<i class="fa fa-check pull-right"></i></li>
        <li><i class="fa fa-calendar"></i> <?=$model->duration?> Days Expiry<i class="fa fa-check pull-right"></i></li>

    </ul>
    <div class="pricing-footer" style="background-color: #17607f">
        <h4 ><i>RM </i><?=explode('.',$model->price)[0]?><i>.00</i></h4>
        <?php if($model->price === '0.00'):?>
            <?php
                $modelClass = explode('\\',$model->className())[2];
            ?>
            <a href="<?=Url::to(['trial/try-now','objectId'=>$model->id,'modelClass'=>$modelClass])?>" class="btn-u btn-brd btn-u-default btn-u-xs"><i class="fa fa-thumbs-up"></i> Try Now</a>
        <?php else:?>
            <a href="#" class="btn-u btn-brd btn-u-default btn-u-xs" onclick="AddToCart('Package-<?=$model->id?>')"><i class="fa fa-shopping-cart"></i> Purchase Now</a>
        <?php endif;?>
    </div>
</div>
