<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 12/1/15
 * Time: 8:35 PM
 */

/* @var $video common\models\Video */

use Vimeo\Vimeo;
use yii\helpers\Url;
?>
<div class="box-shadow shadow-effect-2" style="padding: 0 10px 10px 10px;margin-top: 15px">
    <?php if($model->modelClass === 'Video'):?>
        <?php
        $video = $model->getVideo();
        $lib = new Vimeo(Yii::$app->params['vimeoClientId'],Yii::$app->params['vimeoSecret'],Yii::$app->params['vimeoAccessToken']);
        $response = $lib->request('/me/videos/'.$video->videoId, [], 'GET');
        ?>
        <div class="row">
            <div class="col-md-11">
                <div class="headline" style="margin-bottom: 0;margin-top: 10px">
                    <h3> <a href="<?=Url::to(['/campaign/view','id'=>$model->id])?>"><?=$model->name?></a>  </h3>
                </div>
            </div>
            <div class="col-md-1" style="padding-top: 25px">
                <span class="pull-right label label-info" ><?=$model->codeBank_code?></span>
            </div>
        </div>


        <!--    <iframe width="100%" height="305" scrolling="no" frameborder="no" src="--><!--&autoplay=1"></iframe>-->
        <video width="100%" height="240" controls poster="<?=$response['body']['pictures']['sizes'][3]['link']?>" >
            <source src="<?=$video->sdLink?>" type="video/mp4">
        </video>
        <div class="grid-boxes-caption">

            <ul class="list-inline grid-boxes-news">
                <li><span>By</span> <a href="#"><?=$model->user->username?></a></li>
                <li>|</li>
                <li><i class="fa fa-clock-o"></i> <?=Yii::$app->formatter->asDate($model->created_at,'long')?></li>
                <li>|</li>
                <li><a href="#"><i class="fa fa-caret-square-o-right"></i> <?=$response['body']['stats']['plays']?></a></li>
            </ul>

        </div>
    <?php elseif($model->modelClass === 'Review'):?>

        <div class="grid-boxes-caption" style="padding-top: 5px">
                <div class="headline">
                    <h2> <a href="#"><?=$model->name?></a></h2>
                </div>


            <p><?=substr($model->review->contents, 0, 250);?></p>
            <ul class="list-inline grid-boxes-news">
                <li><span>By</span> <a href="#"><?=$model->user->username?></a></li>
                <li>|</li>
                <li><i class="fa fa-clock-o"></i> <?=Yii::$app->formatter->asDate($model->created_at,'long')?></li>
                <li>|</li>
                <li><a href="#"><i class="fa fa-eye"></i> 12</a></li>
            </ul>
        </div>
    <?php endif;?>
</div>




