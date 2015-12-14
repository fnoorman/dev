<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/23/15
 * Time: 4:13 PM
 */
use yii\helpers\Url;
use common\models\CampaignTracker;
?>



    <div class="col-md-4 col-sm-8">
        <div class="pricing hover-effect">
            <div class="pricing-head">
                <h3><b><?=$model->codeBank_code?></b></h3>
            </div>
            <ul class="pricing-content list-unstyled">

                <li><strong class="color-sea">Expired by </strong><span><?=Yii::$app->formatter->asDatetime($model->codeBank->expiredBy)?></span> </li>
                <li><strong class="color-sea">Call-out</strong>    <span><?=$model->codeBank->maxCallOut?></span> </li>
                <li><strong class="color-sea">Balance</strong>    <span><?=$model->codeBank->minBalance?></span> </li>
                <li><strong class="color-sea">Members</strong>    <span><?=$model->codeBank->membersLabel?></span> </li>
                <li><strong class="color-sea">Purchased</strong>  <span><?=Yii::$app->formatter->asDatetime($model->codeBank->created_at)?></span> </li>

            </ul>
            <div class="pricing-footer">
                <h4>
                    <?php
                    $unique = CampaignTracker::uniqueByCode($model->codeBank_code);
                    ?>
                    <i><?= $unique? $unique:'0' ?></i>
                    <span class="color-sea"><b>UNIQUE VIEW</b></span>
                </h4>
                <h4>
                    <?php
                        $total = CampaignTracker::totalView($model->codeBank_code);
                    ?>
                    <i><?= $total? $total:'0' ?></i>
                    <span class="color-sea"><b>TOTAL VIEW</b></span>
                </h4>
                <style>
                    .pricing-footer a:hover, .pricing-footer button:hover {
                        background: lightgrey;
                    }
                </style>
                <?php if(Yii::$app->user->can('inviteMember',['code'=>$model->codeBank_code])):?>
                    <a class="btn btn-default btn-s" style="margin-top:5px;" href="<?=Url::to(['/code/index','user_id'=>$model->user_id,'code'=>$model->codeBank_code])?>"><i class="fa fa-plus"></i> <i class="fa fa-users"></i></a>
                <?php endif;?>
                <?php if(Yii::$app->user->can('manageCampaign',['code'=>$model->codeBank_code])):?>
                    <a class="btn btn-default btn-s" style="margin-top:5px;"><i class="fa fa-plus"></i> <i class="fa fa-bullhorn"></i></a>
                <?php endif;?>

            </div>
        </div>
    </div>
