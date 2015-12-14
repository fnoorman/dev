<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/23/15
 * Time: 6:34 PM
 */

/* @var $this yii\web\View */
/* @var $model common\models\CodeMember */
/* @var $form yii\widgets\ActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;

?>

<style>
    .reg-page {
        color: #555;
        padding: 30px;
        background: #fefefe;
        border: solid 1px #eee;
        box-shadow: 0 0 3px #eee;
    }

    select:not([multiple]) {
        -webkit-appearance: none;
        -moz-appearance: none;
        background-position: right 50%;
        background-repeat: no-repeat;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAMCAYAAABSgIzaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDZFNDEwNjlGNzFEMTFFMkJEQ0VDRTM1N0RCMzMyMkIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDZFNDEwNkFGNzFEMTFFMkJEQ0VDRTM1N0RCMzMyMkIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0NkU0MTA2N0Y3MUQxMUUyQkRDRUNFMzU3REIzMzIyQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0NkU0MTA2OEY3MUQxMUUyQkRDRUNFMzU3REIzMzIyQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuGsgwQAAAA5SURBVHjaYvz//z8DOYCJgUxAf42MQIzTk0D/M+KzkRGPoQSdykiKJrBGpOhgJFYTWNEIiEeAAAMAzNENEOH+do8AAAAASUVORK5CYII=);
        padding: .5em;
        padding-right: 1.5em
    }


    select.form-control{
        border-radius: 0;

    }
</style>

    <?php $form = ActiveForm::begin([
        'action'=>['/code/create-invitation','user_id'=>Yii::$app->user->id],
        'options'=>['class'=>'reg-page']
    ]);?>
    <p class="text-warning">
        Fill the required information to invite user to participate for the following code
        <span class="label label-warning">
            <?=$model->codeBank_code?>
        </span>

    </p>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group field-codememberform-codebank_code required">

                <input type="text" id="code" class="form-control" name="code" value="<?=$model->codeBank_code?>" disabled="">

            </div>
            <?=$form->field($model,'codeBank_code')->hiddenInput()->label(false)?>
        </div>
        <div class="col-md-5">
            <?=$form->field($model,'email')->textInput(['placeholder'=>'User\'s email to invite'])->label(false)?>
        </div>
        <div class="col-md-3">
            <?=$form->field($model,'auth_item_name')->dropDownList($roleOptions,['prompt'=>'Required role'])->label(false)?>
        </div>
        <div class="col-md-2">

            <button class="tooltips btn-u btn-u-green" type="submit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Click to invite"><i class="fa fa-paper-plane-o"></i></button>
            <a class=" tooltips btn-u btn-u-red" href="<?=Url::to(['/code/index','user_id'=>Yii::$app->user->id])?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Click to close"><i class="fa fa-close"></i></a>

        </div>
    </div>

    <?php ActiveForm::end();?>


