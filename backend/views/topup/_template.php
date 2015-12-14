<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/17/15
 * Time: 11:18 AM
 */
/* @var $model common\models\Topup */
/* @var $this yii\web\View */




?>


<div class="pricing hover-effect">
    <div class="pricing-head">
        <h3 style="background-color: <?=$backgroundColor?>"><?=$model->name?><span>Call out Package</span></h3>

    </div>
    <ul class="pricing-content list-unstyled">


        <li style="font-size: 14px"><i class="icon-tag"></i> <?=$model->unitPrice?> Per Unit<i class="fa fa-check pull-right"></i></li>
        <li style="font-size: 14px"><i class="icon-action-redo"></i> <?=$model->maxCallOut?> Call Out<i class="fa fa-check pull-right"></i></li>


    </ul>
    <div class="pricing-footer" style="margin-top: 25px">
        <h4 style="font-size: 30px"><i>RM </i><?=$model->price?></h4>
        <a href="#package" class="btn-u" style="margin-top: 25px" onclick="AddToCart('Topup-<?=$model->id?>')"><i class="fa fa-shopping-cart"></i> Purchase Now</a>
    </div>
</div>
