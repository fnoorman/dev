<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/24/15
 * Time: 4:56 PM
 */
?>

<div class="profile-blog blog-border">
    <img class="rounded-x" src="assets/img/testimonials/img1.jpg" alt="">
    <div class="name-location">
        <strong><?=ucfirst($model->user->profile->firstname)?> <?=ucfirst($model->user->profile->lastname)?></strong>
        <span><i class="fa fa-envelope"></i><?=$model->user->email?></span>
    </div>
    <div class="clearfix margin-bottom-20"></div>
    <p></p>
    <hr>
    <ul class="list-inline share-list">
        <li><i class="fa fa-group"></i><a href="#"><?=$model->auth_item_name?></a></li>
        <?php if($model->auth_item_name !== 'admin'):?>
            <li><i class="fa fa-trash" style="color:red"></i><a href="#">Remove</a></li>
        <?php endif;?>
    </ul>
</div>
