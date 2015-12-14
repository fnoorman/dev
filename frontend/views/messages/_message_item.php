<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/24/15
 * Time: 10:45 AM
 */
use yii\helpers\Url;
use common\components\timeago\TimeAgoAsset;
TimeAgoAsset::register($this);
use common\components\timeago\TimeAgo;
?>

<div class="media media-v2">
    <a class="pull-left" href="#">
        <img class="media-object rounded-x" src="assets/img/testimonials/img2.jpg" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">
            <strong><a href="#"><?=ucfirst($model->sender->profile->firstname)?> <?=ucfirst($model->sender->profile->lastname)?></a></strong> @<?=$model->sender->username?>
            <small><?=TimeAgo::widget(['timestamp'=>$model->created_at])?></small>
        </h4>
        <?=$model->content?>
        <ul class="list-inline pull-right">
            <li><a href="<?=Url::to(['/messages/delete','id'=>$model->id])?>" data-method="post" data-confirm="Are you sure ?"><i class="icon-custom icon-sm icon-bg-u fa fa-trash"></i></i></a></li>
        </ul>
    </div>
</div><!--/end media media v2-->
