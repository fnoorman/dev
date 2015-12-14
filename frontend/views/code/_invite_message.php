<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/24/15
 * Time: 12:33 AM
 */
use yii\helpers\Html;

    /* @var $user common\models\User */
?>
<div class="row">
    <div class="col-md-12">
        Dear <?=$username?>,
        <p>
            You've have been invited to participate as <?=$role?> for Hybrizy code: <?=$code?>
            Click the Accept button to accept the invitation
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?=Html::a("Accept",['/code/accept','user_id'=>$user_id,'code'=>$code,'role'=>$role,'message_id'=>$message_id],['class'=>'btn btn-success'])?>
    </div>
</div>

