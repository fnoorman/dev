<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 12/10/15
 * Time: 11:42 AM
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

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
</style>

<div class="col-md-9">
    <div class="profile-body">
        <div class="headline">
            <h2>Contest Detail</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'id'=>'',
                    'action'=>['/question/step'],
                    'options' =>['class'=>'sky-form','role'=>'form']
                ])?>
                <header><i class="fa fa-gift"></i>  Question for contest</header>
                <fieldset>
                    <?=$form->field($model,'qType')->dropDownList($model->options,['prompt'=>'Please select question type'])?>
                    <?=$form->field($model,'question')->textarea()->label('What is your question?')?>

                    <?=$form->field($model,'required')->checkbox()?>

                        <div class="headline">
                            <h2>Answer Section</h2>
                        </div>
                        <div id="answers">
                            <?php if(count($answers)>0):?>
                                <?php foreach($answers as $answer):?>
                                    <?=Yii::$app->controller->renderPartial('@frontend/views/answer/_answer_item',['model'=>$answer,'qType'=>$model->qType])?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>



                </fieldset>

                <footer>
                    <div class="form-group" >
                        <?= Html::submitButton( 'Create next question', ['class' =>  'btn btn-primary']) ?>
                    </div>
                </footer>
                <?=$form->field($codeBankCampaign,'codeBank_code')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'name')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'modelClass')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'startDate')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'endDate')->hiddenInput()->label(false)?>



                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('JavascriptInit');?>
<script type="text/javascript">

    function removeMe(id)
    {
        $("div").remove(id);
    }

    function moreAnswer()
    {
        var optionsValue = $('#question-qtype option:selected').val();
        var url = "<?=Url::to(['/api/campaign/objective-answer','qType'=>''])?>" + optionsValue;
        $.get( url, function( data ) {
            $( "#answers").append(data.html);
            alert( "Append was performed." );
        });
    }

    $('#question-qtype').change(function(){
        var btnId = $('#question-qtype option:selected').text();
        var optionsValue = $('#question-qtype option:selected').val();
//        $('#Subjective').hide();
//        $('#Objective').hide();
        console.log(btnId);
        if(btnId == 'Subjective' || btnId == 'Objective')
        {
            var btn = document.getElementById(btnId);
//            btn.removeAttribute('style');
            var url = "<?=Url::to(['/api/campaign/objective-answer','qType'=>''])?>" + optionsValue;
            $.get( url, function( data ) {
                $( "#answers").replaceWith('<div id="answers"></div>');
                $( "#answers").append(data.html);
                alert( "Append was performed." );
            });
        }


    });

    $(document).ready(function(){


    });
</script>

<?php $this->endBlock();?>
