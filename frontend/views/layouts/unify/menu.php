<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/4/15
 * Time: 3:31 PM
 */

/* @var $this \yii\web\View */
/* @var $content string */

//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use common\assets\BaseUnifyAsset;

$urlBase = BaseUnifyAsset::register($this);

?>
<?php $this->beginContent('@frontend/views/layouts/unify/profile.php');?>
<div class="wrapper">
    <!--=== Header ===-->
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="<?=Url::base(true)?>/img/logo-hybrizy.png" alt="Logo" width="50px">
            </a>
            <!-- End Logo -->

            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <li class="hoverSelector">
                        <i class="fa fa-globe"></i>
                        <a>Languages</a>
                        <ul class="languages hoverSelectorBlock">
                            <li class="active">
                                <a href="#">English <i class="fa fa-check"></i></a>
                            </li>
                            <li><a href="#">Spanish</a></li>
                            <li><a href="#">Russian</a></li>
                            <li><a href="#">German</a></li>
                        </ul>
                    </li>
                    <li class="topbar-devider"></li>
                    <li><a href="page_faq.html">Help</a></li>
                    <li class="topbar-devider"></li>
                    <?php if(Yii::$app->user->isGuest):?>
                        <li><a href="<?=Url::to(['/site/login'])?>">Login</a></li>
                    <?php else:?>
                        <li><a href="<?=Url::to(['/site/logout'])?>" data-method="post">Logout (<?=Yii::$app->user->identity->username?>)</a></li>
                    <?php endif;?>
                </ul>
            </div>
            <!-- End Topbar -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <!-- Home -->
                    <li class="<?= in_array('home', $this->params['active']) ? 'active': null?>">
                        <a href="<?=Url::to(['/'])?>">
                            Home
                        </a>
                    </li>
                    <!-- End Home -->


                        <?php if(Yii::$app->user->can('manageCampaign',['code'=>Yii::$app->user->identity->availableCodes])):?>
                            <!-- Profile -->
                            <li class="<?= in_array('profile', $this->params['active']) ? 'active': null?>">
                                <a href="<?=Url::to(['profile/index'])?>">
                                    Profile
                                </a>
                            </li>
                            <!-- End Profile -->

                            <!-- Campaign -->
                            <li class="dropdown <?= in_array('campaign', $this->params['active']) ? 'active': null?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Campaign
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?=Url::to(['/campaign/index'])?>">Manage Campaign</a></li>
                                    <!--?php if(Yii::$app->user->can('inviteMember')):?-->
                                        <li class="<?=in_array('invite',$this->params['active'])? 'active': null?>">
                                            <a href="<?=Url::to(['/video/index'])?>">Video</a>
                                        </li>
                                        <li class="<?=in_array('review',$this->params['active'])? 'active': null?>">
                                            <a href="<?=Url::to(['/review/index'])?>">Review</a>
                                        </li>
                                    <!--?php endif;?-->
                                </ul>
                            </li>
                            <!-- End Campaign -->
                        <?php endif;?>

                        <!-- Features -->
<!--                        <li class="dropdown">-->
<!--                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                                Features-->
<!--                            </a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li class="dropdown-submenu">-->
<!--                                    <a href="javascript:void(0);">Headers</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="feature_header_default.html">Header Default</a></li>-->
<!--                                        <li><a href="feature_header_default_no_topbar.html">Header Default without Topbar</a></li>-->
<!--                                        <li><a href="feature_header_default_centered.html">Header Default Centered</a></li>-->
<!--                                        <li><a href="feature_header_default_fixed.html">Header Default Fixed (Sticky)</a></li>-->
<!--                                        <li><a href="feature_header_default_login_popup.html">Header Default Login Popup</a></li>-->
<!--                                        <li><a href="feature_header_v1.html">Header v1</a></li>-->
<!--                                        <li><a href="feature_header_v2.html">Header v2</a></li>-->
<!--                                        <li><a href="feature_header_v3.html">Header v3</a></li>-->
<!--                                        <li><a href="feature_header_v4.html">Header v4</a></li>-->
<!--                                        <li><a href="feature_header_v4_logo_centered.html">Header v4 Centered Logo</a></li>-->
<!--                                        <li><a href="feature_header_v5.html">Header v5</a></li>-->
<!--                                        <li><a href="feature_header_v6_transparent.html">Header v6 Transparent</a></li>-->
<!--                                        <li><a href="feature_header_v6_semi_dark_transparent.html">Header v6 Dark Transparent</a></li>-->
<!--                                        <li><a href="feature_header_v6_semi_white_transparent.html">Header v6 White Transparent</a></li>-->
<!--                                        <li><a href="feature_header_v6_border_bottom.html">Header v6 Border Bottom</a></li>-->
<!--                                        <li><a href="feature_header_v6_classic_dark.html">Header v6 Classic Dark</a></li>-->
<!--                                        <li><a href="feature_header_v6_classic_white.html">Header v6 Classic White</a></li>-->
<!--                                        <li><a href="feature_header_v6_dark_dropdown.html">Header v6 Dark Dropdown</a></li>-->
<!--                                        <li><a href="feature_header_v6_dark_scroll.html">Header v6 Dark on Scroll</a></li>-->
<!--                                        <li><a href="feature_header_v6_dark_search.html">Header v6 Dark Search</a></li>-->
<!--                                        <li><a href="feature_header_v6_dark_res_nav.html">Header v6 Dark in Responsive</a></li>-->
<!--                                        <li><a href="page_home12.html">Header v7 Left Sidebar</a></li>-->
<!--                                        <li><a href="page_home13.html">Header v7 Right Sidebar</a></li>-->
<!--                                        <li><a href="feature_header_v8.html">Header v8</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li class="dropdown-submenu">-->
<!--                                    <a href="javascript:void(0);">Footers</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="feature_footer_default.html#footer-default">Footer Default</a></li>-->
<!--                                        <li><a href="feature_footer_v1.html#footer-v1">Footer v1</a></li>-->
<!--                                        <li><a href="feature_footer_v2.html#footer-v2">Footer v2</a></li>-->
<!--                                        <li><a href="feature_footer_v3.html#footer-v3">Footer v3</a></li>-->
<!--                                        <li><a href="feature_footer_v4.html#footer-v4">Footer v4</a></li>-->
<!--                                        <li><a href="feature_footer_v5.html#footer-v5">Footer v5</a></li>-->
<!--                                        <li><a href="feature_footer_v6.html#footer-v6">Footer v6</a></li>-->
<!--                                        <li><a href="feature_footer_v7.html#footer-v7">Footer v7</a></li>-->
<!--                                        <li><a href="feature_footer_v8.html#footer-v8">Footer v8</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li><a href="feature_gallery.html">Gallery Examples</a></li>-->
<!--                                <li><a href="feature_animations.html">Animations on Scroll</a></li>-->
<!--                                <li><a href="feature_parallax_counters.html">Parallax Counters</a></li>-->
<!--                                <li><a href="feature_testimonials_quotes.html">Testimonials and Quotes</a></li>-->
<!--                                <li><a href="feature_icon_blocks.html">Icon Blocks</a></li>-->
<!--                                <li><a href="feature_team_blocks.html">Team Blocks</a></li>-->
<!--                                <li><a href="feature_news_blocks.html">News Blocks</a></li>-->
<!--                                <li><a href="feature_parallax_blocks.html">Parallax Blocks</a></li>-->
<!--                                <li><a href="feature_funny_boxes.html">Funny Boxes</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                        <!-- End Features -->

                    <!-- Search Block -->
                    <li>
                        <i class="search fa fa-search search-btn"></i>
                        <div class="search-open">
                            <div class="input-group animated fadeInDown">
                                <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button class="btn-u" type="button">Go</button>
                                    </span>
                            </div>
                        </div>
                    </li>
                    <!-- End Search Block -->
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->
    <!--===  Content ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="<?=$urlBase->baseUrl?>/img/team/img32-md.jpg" alt="">

                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <?php if(Yii::$app->user->identity->hasCode() > 0):?>
                        <li class="list-group-item">
                            <a href="page_profile_projects.html"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="list-group-item <?= in_array('hybrizy', $this->params['active']) ? 'active': null?>">
                            <a href="<?=Url::to(['/code/index','user_id'=>Yii::$app->user->id])?>"><i class="fa fa-code"></i>
                                Hybrizy Code
                                <span class="label label-info pull-right">
                                    <?=Yii::$app->user->identity->codeCount?>
                                </span>
                            </a>

                        </li>
                        <!-- Topup Start -->
                            <?php if(Yii::$app->user->identity->hasTopup() > 0):?>
                                <li class="list-group-item">
                                    <a href="page_profile.html"><i class="fa fa-retweet"></i>
                                        Available Topup
                                    <span class="label label-danger pull-right">
                                        <?=Yii::$app->user->identity->availableTopup?>
                                    </span>
                                    </a>

                                </li>
                            <?php endif;?>
                        <!-- Campaign Start -->
                        <?php if(Yii::$app->user->can('manageCampaign',['code'=>Yii::$app->user->identity->availableCodes])):?>
                            <li class="list-group-item">
                                <a href="<?=Url::to(['/campaign/index'])?>"><i class="fa fa-bullhorn"></i> Campaign</a>
                            </li>
                        <?php endif;?>
                        <!-- Campaign End -->

                        <li class="list-group-item <?= in_array('group', $this->params['active']) ? 'active': null?>">
                            <?php
//                                $temp = '/xxx';
                                $temp = Url::to(['/code/index','user_id'=>Yii::$app->user->id,'group_code'=>true]);
                                $tempUrl = (count(Yii::$app->user->identity->availableGroupCodes) > 0) ? "href='$temp'" : null;
                            ?>

                            <a <?=$tempUrl?>>
                                <i class="fa fa-group"></i>
                                    My Group
                                <?php if(count(Yii::$app->user->identity->availableGroupCodes)> 0):?>
                                    <span class="label label-danger pull-right">
                                        <?=count(Yii::$app->user->identity->availableGroupCodes)?>
                                    </span>
                                <?php endif;?>
                            </a>
                        </li>

                        <li class="list-group-item <?= in_array('profile_me', $this->params['active']) ? 'active': null?>">
                            <a href="<?=Url::to(['/profile/index'])?>"><i class="fa fa-user"></i> Profile</a>
                        </li>

                    <?php endif;?>



                    <li class="list-group-item">
                        <a href="<?=Url::to(['/messages/index','read'=>0])?>">
                            <i class="fa fa-comments">
                            </i>
                            Messages
                            <span class="label label-danger pull-right">
                                <?=Yii::$app->user->identity->unreadMessages?>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#"><i class="fa fa-history"></i> History</a>
                    </li>
                    <li class="list-group-item <?= in_array('profile_settings', $this->params['active']) ? 'active': null?>">
                        <a href="<?=Url::to(['/profile/setting'])?>"><i class="fa fa-cog"></i> Settings</a>
                    </li>
                </ul>

<!--                <div class="panel-heading-v2 overflow-h">-->
<!--                    <h2 class="heading-xs pull-left"><i class="fa fa-bar-chart-o"></i> Task Progress</h2>-->
<!--                    <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                </div>-->
<!--                <h3 class="heading-xs">Web Design <span class="pull-right">92%</span></h3>-->
<!--                <div class="progress progress-u progress-xxs">-->
<!--                    <div style="width: 92%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="92" role="progressbar" class="progress-bar progress-bar-u">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <h3 class="heading-xs">Unify Project <span class="pull-right">85%</span></h3>-->
<!--                <div class="progress progress-u progress-xxs">-->
<!--                    <div style="width: 85%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" role="progressbar" class="progress-bar progress-bar-blue">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <h3 class="heading-xs">Sony Corporation <span class="pull-right">64%</span></h3>-->
<!--                <div class="progress progress-u progress-xxs margin-bottom-40">-->
<!--                    <div style="width: 64%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="64" role="progressbar" class="progress-bar progress-bar-dark">-->
<!--                    </div>-->
<!--                </div>-->

                <hr>

                <!--Notification-->
<!--                <div class="panel-heading-v2 overflow-h">-->
<!--                    <h2 class="heading-xs pull-left"><i class="fa fa-bell-o"></i> Notification</h2>-->
<!--                    <a href="#"><i class="fa fa-cog pull-right"></i></a>-->
<!--                </div>-->
<!--                <ul class="list-unstyled mCustomScrollbar margin-bottom-20" data-mcs-theme="minimal-dark">-->
<!--                    <li class="notification">-->
<!--                        <i class="icon-custom icon-sm rounded-x icon-bg-red icon-line icon-envelope"></i>-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Albert Heller</strong> has sent you email.</span>-->
<!--                            <small>Two minutes ago</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="notification">-->
<!--                        <img class="rounded-x" src="--><!--?//=$urlBase->baseUrl?><!--/img/testimonials/img6.jpg" alt="">-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Taylor Lee</strong> started following you.</span>-->
<!--                            <small>Today 18:25 pm</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="notification">-->
<!--                        <i class="icon-custom icon-sm rounded-x icon-bg-yellow icon-line fa fa-bolt"></i>-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Natasha Kolnikova</strong> accepted your invitation.</span>-->
<!--                            <small>Yesterday 1:07 pm</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="notification">-->
<!--                        <img class="rounded-x" src="--><!--?//=$urlBase->baseUrl?><!--/img/testimonials/img1.jpg" alt="">-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Mikel Andrews</strong> commented on your Timeline.</span>-->
<!--                            <small>23/12 11:01 am</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="notification">-->
<!--                        <i class="icon-custom icon-sm rounded-x icon-bg-blue icon-line fa fa-comments"></i>-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Bruno Js.</strong> added you to group chating.</span>-->
<!--                            <small>Yesterday 1:07 pm</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="notification">-->
<!--                        <img class="rounded-x" src="--><!--?//=$urlBase->baseUrl?><!--/img/testimonials/img6.jpg" alt="">-->
<!--                        <div class="overflow-h">-->
<!--                            <span><strong>Taylor Lee</strong> changed profile picture.</span>-->
<!--                            <small>23/12 15:15 pm</small>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--                <button type="button" class="btn-u btn-u-default btn-u-sm btn-block">Load More</button>-->
                <!--End Notification-->

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form>
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
                <?=$content?>
        </div>
    </div>
    <!--=== End Content ===-->
</div>


<?php $this->endContent();?>


