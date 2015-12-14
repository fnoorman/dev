<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/4/15
 * Time: 3:11 PM
 */
use common\assets\ProfileUnifyAsset;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use common\models\CampaignTracker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$labels = [];
$unique = [];
$total = [];
$selected = null;
if(isset($selectedCode))
{
    $temp = CampaignTracker::ViewUniqueByDuration(8,$allCodes[$selectedCode]);
    $labels = array_keys($temp);
    $unique = array_values($temp);
    $total = array_values(CampaignTracker::ViewDailyByDuration(8,$allCodes[$selectedCode]));
    $selected = array_search($allCodes[$selectedCode],$allCodes);
}

$urlBase = ProfileUnifyAsset::register($this);
$this->params['active'] = ['profile','profile_me'];


/* @var $this yii\web\View */

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
<!--=== Profile ===-->
        <!-- Profile Content -->
        <div class="col-md-9">
            <div class="profile-body">
                <div class="profile-bio">
                    <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3">
                            <?=Html::dropDownList('analytic',$selected,$allCodes,['prompt'=>'Please select code','class'=>'form-control','id'=>'code-select'])?>
                        </div>


                    </div>
                    <div class="row">
                        <?php if(count($labels) > 0 && count($total)> 0 && count($unique)>0):?>
                        <div class="col-md-12" >
                            <?= ChartJs::widget([
                                'type' => 'Line',
                                'clientOptions'=>[
                                  'responsive'=>true
                                ],
                                'options'=>['style'=>'padding-right:30px;padding-top:10px','height'=>100],
//                                'options' => [
//                                    'height' => 400,
//                                    'width' => 400
//                                ],
                                'data' => [
                                    'labels' => $labels,
                                    'datasets' => [
                                        [
                                            'fillColor' => "rgba(220,220,220,0.5)",
                                            'strokeColor' => "rgba(220,220,220,1)",
                                            'pointColor' => "rgba(220,220,220,1)",
                                            'pointStrokeColor' => "#fff",
                                            'data' => $total
                                        ],
                                        [
                                            'fillColor' => "rgba(151,187,205,0.5)",
                                            'strokeColor' => "rgba(151,187,205,1)",
                                            'pointColor' => "rgba(151,187,205,1)",
                                            'pointStrokeColor' => "#fff",
                                            'data' => $unique
                                        ]
                                    ]
                                ]
                            ]);
                            ?>
                        </div>
                            <?php else:?>
                                <h2 style="text-align: center">Please select code to view data</h2>

                        <?php endif;?>
                    </div>
                </div><!--/end row-->

                <hr>

                <div class="row">
                    <!--Social Icons v3-->
<!--                    <div class="col-sm-6 sm-margin-bottom-30">-->
<!--                        <div class="panel panel-profile">-->
<!--                            <div class="panel-heading overflow-h">-->
<!--                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i> Social Contacts <small>(option 1)</small></h2>-->
<!--                                <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                            </div>-->
<!--                            <div class="panel-body">-->
<!--                                <ul class="list-unstyled social-contacts-v2">-->
<!--                                    <li><i class="rounded-x tw fa fa-twitter"></i> <a href="#">edward.rooster</a></li>-->
<!--                                    <li><i class="rounded-x fb fa fa-facebook"></i> <a href="#">Edward Rooster</a></li>-->
<!--                                    <li><i class="rounded-x sk fa fa-skype"></i> <a href="#">edwardRooster77</a></li>-->
<!--                                    <li><i class="rounded-x gp fa fa-google-plus"></i> <a href="#">rooster77edward</a></li>-->
<!--                                    <li><i class="rounded-x gm fa fa-envelope"></i> <a href="#">edward77@gmail.com</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!--End Social Icons v3-->

                    <!--Profile Post-->
                    <div class="col-sm-6">
                        <div class="panel panel-profile no-bg">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-code"></i>Hybrizy Code</h2>
                                <a href="#"><i class="fa fa-cog pull-right"></i></a>
                            </div>
                            <div id="scrollbar" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                                <?php if(count($model) > 0):?>
                                    <?=Yii::$app->controller->renderPartial('_code_widget',['model'=>$model,'roleOptions'=>$roleOptions])?>
                                <?php else:?>
                                    <div class="profile-post color-seven">
                                        <span class="profile-post-numb"></span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs">
                                                <a ><span class="text-danger">No Hybrizy Code</span></a></h3>
                                            <p>Feel free to try out our product by using
                                                <a href="<?=Url::to(['/#packages'])?>">
                                                    Free Package code.
                                                </a>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <!--End Profile Post-->


                    <!--Skills-->
                    <div class="col-sm-6 sm-margin-bottom-30">
                        <div class="panel panel-profile">
                            <div class="panel-heading overflow-h">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-bullhorn"></i> Campaign</h2>
                                <a href="#"><i class="fa fa-cog pull-right"></i></a>
                            </div>
                            <div class="panel-body">
                                <?php foreach($campaigns as $campaign):?>
                                <h6><?=$campaign->name?> <span class="label label-purple"><?=$campaign->codeBank_code?></span><span class="label label-red"><?=$campaign->modelClass?></span></h6>

                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <!--End Skills-->
                </div><!--/end row-->

                <hr>

<!--                <!--Timeline-->
<!--                <div class="panel panel-profile">-->
<!--                    <div class="panel-heading overflow-h">-->
<!--                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i> Experience</h2>-->
<!--                        <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                    </div>-->
<!--                    <div class="panel-body margin-bottom-40">-->
<!--                        <ul class="timeline-v2 timeline-me">-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>Mobile Design</span> <span>2012 - Current</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>BFC NYC Partners</h2>-->
<!--                                    <p>Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Peasprouts wattle seed rutabaga okra yarrow cress avocado grape.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>Web Designer</span> <span>2007 - 2012</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>Freelance</h2>-->
<!--                                    <p>Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>Photodesigner</span> <span>2003 - 2007</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>Toren Condo</h2>-->
<!--                                    <p>Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <!--End Timeline-->
<!---->
<!--                <!--Timeline-->
<!--                <div class="panel panel-profile">-->
<!--                    <div class="panel-heading overflow-h">-->
<!--                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-mortar-board"></i> Education</h2>-->
<!--                        <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                    </div>-->
<!--                    <div class="panel-body">-->
<!--                        <ul class="timeline-v2 timeline-me">-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>Bachelor of IT</span> <span>2003 - 2000</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>Harvard University</h2>-->
<!--                                    <p>Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. Peasprouts wattle seed rutabaga okra yarrow cress avocado grape.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>Web Design</span> <span>1997 - 2000</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>Imperial College London</h2>-->
<!--                                    <p>Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <time datetime="" class="cbp_tmtime"><span>High School</span> <span>1988 - 1997</span></time>-->
<!--                                <i class="cbp_tmicon rounded-x hidden-xs"></i>-->
<!--                                <div class="cbp_tmlabel">-->
<!--                                    <h2>Chicago High School</h2>-->
<!--                                    <p>Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot.</p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <!--End Timeline-->
<!---->
<!--                <hr>-->
<!---->
<!--                <div class="row">-->
<!--                    <!--Social Contacts v2-->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="panel panel-profile">-->
<!--                            <div class="panel-heading overflow-h">-->
<!--                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-lightbulb-o"></i> Social Contacts <small>(option 2)</small></h2>-->
<!--                                <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                            </div>-->
<!--                            <div class="panel-body">-->
<!--                                <ul class="list-unstyled social-contacts-v3">-->
<!--                                    <li><i class="rounded-x tw fa fa-twitter"></i> <a href="#">edward.rooster</a></li>-->
<!--                                    <li><i class="rounded-x fb fa fa-facebook"></i> <a href="#">Edward Rooster</a></li>-->
<!--                                    <li><i class="rounded-x sk fa fa-skype"></i> <a href="#">edwardRooster77</a></li>-->
<!--                                    <li><i class="rounded-x gp fa fa-google-plus"></i> <a href="#">rooster77edward</a></li>-->
<!--                                    <li><i class="rounded-x gm icon-envelope"></i> <a href="#">edward77@gmail.com</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <!--End Social Contacts v2-->
<!---->
<!--                    <!--Design Skills-->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="panel panel-profile">-->
<!--                            <div class="panel-heading overflow-h">-->
<!--                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i> Language Skills</h2>-->
<!--                                <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                            </div>-->
<!--                            <div class="panel-body">-->
<!--                                <div class="row">-->
<!--                                    <div class="p-chart col-sm-6 col-xs-6 sm-margin-bottom-10">-->
<!--                                        <div class="circle margin-bottom-20" id="circle-4"></div>-->
<!--                                        <h3 class="heading-xs">Engagement Score</h3>-->
<!--                                        <p>Celery coriander bitterleaf epazote radicchio shallot.</p>-->
<!--                                    </div>-->
<!--                                    <div class="p-chart col-sm-6 col-xs-6">-->
<!--                                        <div class="circle margin-bottom-20" id="circle-5"></div>-->
<!--                                        <h3 class="heading-xs">Progfile Completness</h3>-->
<!--                                        <p>Celery coriander bitterleaf epazote radicchio shallot.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <!--End Design Skills-->
<!--                </div><!--/end row-->
            </div>
        </div>
        <!-- End Profile Content -->

<!--=== End Profile ===-->

<?php $this->beginBlock('JavascriptInit');?>
<script type="text/javascript">
    $('#code-select').change(function(){
//        alert($('#code-select option:selected').val());
        var code = $('#code-select option:selected').val();
        var url = "<?=Url::base(true)?>/profile/index?code=" + code;
        window.location.replace(url);
    });
</script>
<?php $this->endBlock();?>
