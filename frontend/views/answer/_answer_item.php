<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 12/10/15
 * Time: 3:13 PM
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */

$id = uniqid();
?>
<div class="row" id="<?=$id?>">
    <?php if($qType == '1'):?>
        <div class="form-group col-md-5 field-answer-answer required">
            <?=Html::input('text','Answer[answer][]',$model->answer,['class'=>'form-control','placeholder'=>"Answer's options"])?>
            <div class="help-block"></div>
        </div>
    <?php endif;?>
    <div class="form-group col-md-4">
        <?php if($qType == '0'):?>
            <?=Html::input('text','Answer[correctSubjective][]',$model->correctSubjective,['class'=>'form-control','placeholder'=>'Place the correct answer here'])?>
        <?php else:?>
            <?=Html::activeCheckbox($model,'correctObjective',['name'=>'Answer[correctObjective][]','label'=>'Tick if this is the answer'])?>
        <?php endif;?>
    </div>
    <?php if($qType == '1'):?>
        <div class="form-group col-md-3">
            <button class="btn-u" type="button" onclick="moreAnswer()"><i class="fa fa-plus"></i></button>
            <button class="btn-u btn-u-red" type="button" onclick="removeMe('#<?=$id?>')"><i class="fa fa-times"></i></button>
        </div>
    <?php endif;?>

</div>



