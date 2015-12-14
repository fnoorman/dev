<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\ProfileUnifyAsset;
use dosamigos\datepicker\DateRangePicker;
//use dosamigos\datepicker\DatePicker;



$web = ProfileUnifyAsset::register($this);



/* @var $this yii\web\View */
/* @var $model common\models\CodeBankCampaign */

$this->title = Yii::t('app', 'Create Code Bank Campaign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Code Bank Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['active']=['campaign'];



?>
<style>
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

    div.required label.control-label:after {
        content: " *";
        color: red;
    }

    .datepicker-range input {
        border-radius: 0 !important;
    }
</style>
<div class="col-md-9">
<div class="profile-body">
    <div class="headline">
        <h2>Step 1</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                <h2>Please define your campaign information</h2>
                <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
            </div>
        </div>
    </div>

            <?php $form = ActiveForm::begin([
                'action'=>['create','step'=>'2'],
                'options'=>['class'=>'sky-form','role'=>'form']
            ]);?>
                <header><i class="fa fa-bullhorn"></i>  Campaign Detail Information</header>

                <fieldset>
                    <?=Html::errorSummary($model)?>
                    <?=$form->field($model,'codeBank_code')->dropDownList($codes,['prompt'=>'Please select Hybrizy Code'])?>
                    <?=$form->field($model,'name')?>
                    <?=$form->field($model,'modelClass')->dropDownList(Yii::$app->params['campaignOptions'],['prompt'=>'Please select Campaign Type'])?>
                    <?=$form->field($model,'dateFrom')->widget(DateRangePicker::className(),[
                        'attributeTo'=>'dateTo',
                        'form'=>$form,
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-M-yyyy'
                        ]
                        ])?>
                </fieldset>
                <footer>
                    <div class="form-group">
                        <?= Html::submitButton( 'Next Step', ['class' =>  'btn btn-primary']) ?>
                    </div>
                </footer>




            <?php ActiveForm::end();?>
</div>

</div>

<?php $this->beginBlock('JavascriptInit') ?>

<?php $this->endBlock()?>




