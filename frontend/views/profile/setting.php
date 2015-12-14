<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/5/15
 * Time: 12:05 PM
 */

/* @var $this yii\web\View */
/* @var $userForm common\models\User */
/* @var $payment common\models\ProfileForm */
use \common\assets\ProfileUnifyAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Alert;

$urlBase = ProfileUnifyAsset::register($this);
$this->params['active']=['profile_settings','profile'];
?>

<!--=== Profile ===-->
        <!-- Profile Content -->
        <div class="col-md-9">
            <div class="profile-body margin-bottom-20">
                <div class="tab-v1">
                    <ul class="nav nav-justified nav-tabs">
                        <li <?= ($tab === 'profile')? 'class="active"':''?>><a data-toggle="tab" href="#profile">Edit Profile</a></li>
                        <li <?= ($tab === 'passwordTab')? 'class="active"':''?>><a data-toggle="tab" href="#passwordTab">Change Password</a></li>
                        <li <?= ($tab === 'payment')? 'class="active"':''?>><a data-toggle="tab" href="#payment">Payment Options</a></li>
                        <li class="hidden"><a data-toggle="tab" href="#settings">Notification Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <!--    Profile                         -->
                        <div id="profile" class="profile-edit tab-pane fade<?= ($tab === 'profile')? ' in active':''?>">
                            <h2 class="heading-md">Manage your Username, ID and Email Addresses.</h2>
                            <p>
                                Below are the name and email addresses on file for your account.

                            </p>
                            <br>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn-u btn-default pull-right" type="button" id="edit_profile"><i class="fa fa-pencil"></i></button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12" id="user" <?=$userForm->hasErrors()? 'style="display:none"': null  ?>>
                                    <dl class="dl-horizontal" >

                                        <dt><strong>Your ID </strong></dt>
                                        <dd>
                                            <?=Yii::$app->user->identity->id?>
                                            <span>

                                        </span>
                                        </dd>
                                        <hr>
                                        <dt><strong>User name </strong></dt>
                                        <dd>
                                            <?=Yii::$app->user->identity->username?>
                                            <span>

                                        </span>
                                        </dd>

                                        <hr>
                                        <dt><strong>Primary Email Address </strong></dt>
                                        <dd>
                                            <?=Yii::$app->user->identity->email?>
                                            <span>

                                        </span>
                                        </dd>
                                        <hr>
                                    </dl>
                                </div>

                                <div class="col-lg-12" id="user_form" <?=!$userForm->hasErrors()? 'style="display:none"': null  ?>>
                                    <?=Yii::$app->controller->renderPartial('_user_form',['model'=>$userForm])?>
                                </div>

                            </div>
                        </div>
                        <!--    Password                        -->
                        <div id="passwordTab" class="profile-edit tab-pane fade<?= ($tab === 'passwordTab')? ' in active':''?>">
                            <h2 class="heading-md">Manage your Security Settings</h2>
                            <p>Change your password.</p>
                            <br>
                            <?=isset($message['passwordTab'])? $message['passwordTab']:''?>
                            <?=Yii::$app->controller->renderPartial('_change_password_form',['model'=>$passwordForm])?>
                        </div>

                        <div id="payment" class="profile-edit tab-pane fade<?= ($tab === 'payment')? ' in active':''?>">
                            <h2 class="heading-md">Manage your Payment Settings</h2>
                            <p>Below are the payment options for your account.</p>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn-u btn-default pull-right" type="button" id="edit_payment"><i class="fa fa-pencil"></i></button>
                                </div>
                            </div>
                            <div class="row">

                                    <div class="col-lg-12" id="payment_info" <?=$paymentForm->hasErrors()? 'style="display:none"': null  ?>>
                                        <?=Yii::$app->controller->renderPartial('_payment_detail_view',['model'=>$paymentForm])?>
                                    </div>

                                    <div class="col-lg-12" id="payment_form" <?=!$paymentForm->hasErrors()? 'style="display:none"': null  ?>">
                                        <?=Yii::$app->controller->renderPartial('_payment_form',['model'=>$paymentForm])?>
                                    </div>

                            </div>

                        </div>

                        <div id="settings" class="profile-edit tab-pane fade hidden">
                            <h2 class="heading-md">Manage your Notifications.</h2>
                            <p>Below are the notifications you may manage.</p>
                            <br>
                            <form class="sky-form" id="sky-form3" action="#">
                                <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Email notification</label>
                                <hr>
                                <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification when a user comments on my blog</label>
                                <hr>
                                <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification for the latest update</label>
                                <hr>
                                <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification when a user sends me message</label>
                                <hr>
                                <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Receive our monthly newsletter</label>
                                <hr>
                                <button type="button" class="btn-u btn-u-default">Reset</button>
                                <button class="btn-u" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Profile Content -->

<!--=== End Profile ===-->

<?php $this->beginBlock('JavascriptInit');?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#edit_profile').click(function(){
               $('#user').toggle();
               $('#user_form').toggle();
            });
            $('#edit_payment').click(function(){
               $('#payment_info').toggle();
               $('#payment_form').toggle();
            });
        });
    </script>
<?php $this->endBlock();?>

