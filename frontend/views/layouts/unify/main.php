<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\assets\BasicUnifyAsset;
use common\assets\BasicPluginUnifyAsset;
use common\assets\HeaderAndFooterUnifyAsset;

use common\widgets\Alert;

$basicUnify = BasicUnifyAsset::register($this);
HeaderAndFooterUnifyAsset::register($this);
BasicPluginUnifyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$basicUnify->baseUrl?>/favicon.ico">

    <!-- Web Fonts -->
    <link rel="shortcut" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin">


    <?php $this->head() ?>

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/theme-colors/blue.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/custom.css">

</head>
<body class="header-fixed">
<?php $this->beginBody() ?>
    <div class="wrapper">
        <!--=== Header v3 ===-->
        <div class="header-v3 header-sticky">
            <!-- Navbar -->
            <div class="navbar navbar-default mega-menu" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">
                            <img id="logo-header" src="<?=$basicUnify->baseUrl?>/img/logo-hybrizy.png" alt="Logo" style="width: 40px">
                        </a>
                    </div>

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

                                <?php if(Yii::$app->user->can('manageCampaign') || Yii::$app->user->can('manageAllCampaign')):?>
                                    <!-- Campaign -->
                                    <li class="dropdown <?= in_array('campaign', $this->params['active']) ? 'active': null?>">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                            Campaign
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?=Url::to(['/campaign/default/index'])?>">Manage Campaign</a></li>
                                            <?php if(Yii::$app->user->can('inviteMember')):?>
                                                <li class="<?=in_array('invite',$this->params['active'])? 'active': null?>">
                                                    <a href="<?=Url::to(['/campaign/default/invite'])?>">Invite member</a>
                                                </li>
                                            <?php endif;?>
                                        </ul>
                                    </li>
                                    <!-- End Campaign -->
                                <?php endif;?>

                                <!-- Shortcodes -->
                                <li class="dropdown mega-menu-fullwidth">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                        Shortcodes
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="mega-menu-content disable-icons">
                                                <div class="container">
                                                    <div class="row equal-height">
                                                        <div class="col-md-3 equal-height-in">
                                                            <ul class="list-unstyled equal-height-list">
                                                                <li><h3>Typography &amp; Components</h3></li>

                                                                <!-- Typography -->
                                                                <li><a href="shortcode_typo_general.html"><i class="fa fa-sort-alpha-asc"></i> General Typography</a></li>
                                                                <li><a href="shortcode_typo_headings.html"><i class="fa fa-magic"></i> Headings Options</a></li>
                                                                <li><a href="shortcode_typo_dividers.html"><i class="fa fa-ellipsis-h"></i> Dividers</a></li>
                                                                <li><a href="shortcode_typo_blockquote.html"><i class="fa fa-quote-left"></i> Blockquote Blocks</a></li>
                                                                <li><a href="shortcode_typo_boxshadows.html"><i class="fa fa-asterisk"></i> Box Shadows</a></li>
                                                                <li><a href="shortcode_typo_testimonials.html"><i class="fa fa-comments"></i> Testimonials</a></li>
                                                                <li><a href="shortcode_typo_tagline_boxes.html"><i class="fa fa-tasks"></i> Tagline Boxes</a></li>
                                                                <li><a href="shortcode_typo_grid.html"><i class="fa fa-align-justify"></i> Grid Layouts</a></li>
                                                                <!-- End Typography -->

                                                                <!-- Components -->
                                                                <li><a href="shortcode_compo_messages.html"><i class="fa fa-comment"></i> Alerts &amp; Messages</a></li>
                                                                <li><a href="shortcode_compo_labels.html"><i class="fa fa-tags"></i> Labels &amp; Badges</a></li>
                                                                <li><a href="shortcode_compo_media.html"><i class="fa fa-volume-down"></i> Audio/Videos &amp; Images</a></li>
                                                                <li><a href="shortcode_compo_pagination.html"><i class="fa fa-arrows-h"></i> Paginations</a></li>
                                                                <!-- End Components -->
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3 equal-height-in">
                                                            <ul class="list-unstyled equal-height-list">
                                                                <li><h3>Buttons &amp; Icons</h3></li>

                                                                <!-- Buttons -->
                                                                <li><a href="shortcode_btn_general.html"><i class="fa fa-flask"></i> General Buttons</a></li>
                                                                <li><a href="shortcode_btn_brands.html"><i class="fa fa-html5"></i> Brand &amp; Social Buttons</a></li>
                                                                <li><a href="shortcode_btn_effects.html"><i class="fa fa-bolt"></i> Loading &amp; Hover Effects</a></li>
                                                                <!-- End Buttons -->

                                                                <!-- Icons -->
                                                                <li><a href="shortcode_icon_general.html"><i class="fa fa-chevron-circle-right"></i> General Icons</a></li>
                                                                <li><a href="shortcode_icon_fa.html"><i class="fa fa-chevron-circle-right"></i> Font Awesome Icons</a></li>
                                                                <li><a href="shortcode_icon_line.html"><i class="fa fa-chevron-circle-right"></i> Line Icons</a></li>
                                                                <li><a href="shortcode_icon_glyph.html"><i class="fa fa-chevron-circle-right"></i> Glyphicons Icons (Bootstrap)</a></li>
                                                                <!-- End Icons -->
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3 equal-height-in">
                                                            <ul class="list-unstyled equal-height-list">
                                                                <li><h3>Common elements</h3></li>

                                                                <!-- Common Elements -->
                                                                <li><a href="shortcode_thumbnails.html"><i class="fa fa-image"></i> Thumbnails</a></li>
                                                                <li><a href="shortcode_accordion_and_tabs.html"><i class="fa fa-list-ol"></i> Accordion &amp; Tabs</a></li>
                                                                <li><a href="shortcode_timeline1.html"><i class="fa fa-dot-circle-o"></i> Timeline Option 1</a></li>
                                                                <li><a href="shortcode_timeline2.html"><i class="fa fa-dot-circle-o"></i> Timeline Option 2</a></li>
                                                                <li><a href="shortcode_table_general.html"><i class="fa fa-table"></i> Tables</a></li>
                                                                <li><a href="shortcode_compo_progress_bars.html"><i class="fa fa-align-left"></i> Progress Bars</a></li>
                                                                <li><a href="shortcode_compo_panels.html"><i class="fa fa-columns"></i> Panels</a></li>
                                                                <li><a href="shortcode_carousels.html"><i class="fa fa-sliders"></i> Carousel Examples</a></li>
                                                                <li><a href="shortcode_maps_google.html"><i class="fa fa-map-marker"></i> Google Maps</a></li>
                                                                <li><a href="shortcode_maps_vector.html"><i class="fa fa-align-center"></i> Vector Maps</a></li>
                                                                <!-- End Common Elements -->
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3 equal-height-in">
                                                            <ul class="list-unstyled equal-height-list">
                                                                <li><h3>Forms &amp; Infographics</h3></li>

                                                                <!-- Forms -->
                                                                <li><a href="shortcode_form_general.html"><i class="fa fa-bars"></i> Common Bootstrap Forms</a></li>
                                                                <li><a href="shortcode_form_general1.html"><i class="fa fa-bars"></i> General Unify Forms</a></li>
                                                                <li><a href="shortcode_form_advanced.html"><i class="fa fa-bars"></i> Advanced Forms</a></li>
                                                                <li><a href="shortcode_form_layouts.html"><i class="fa fa-bars"></i> Form Layouts</a></li>
                                                                <li><a href="shortcode_form_layouts_advanced.html"><i class="fa fa-bars"></i> Advanced Layout Forms</a></li>
                                                                <li><a href="shortcode_form_states.html"><i class="fa fa-bars"></i> Form States</a></li>
                                                                <li><a href="shortcode_form_sliders.html"><i class="fa fa-bars"></i> Form Sliders</a></li>
                                                                <li><a href="shortcode_form_modals.html"><i class="fa fa-bars"></i> Modals</a></li>
                                                                <!-- End Forms -->

                                                                <!-- Infographics -->
                                                                <li><a href="shortcode_compo_charts.html"><i class="fa fa-pie-chart"></i> Charts &amp; Countdowns</a></li>
                                                                <!-- End Infographics -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- End Shortcodes -->

                                <!-- Signup -->
                                <li class="<?= in_array('signup', $this->params['active']) ? 'active': null?>">
                                    <?php if(Yii::$app->user->isGuest):?>
                                        <a href="<?=Url::to(['/site/signup'])?>">signup</a>
                                    <?php endif;?>
                                </li>
                                <!-- End Signup -->

                                <!-- logout/login Pages -->
                                <li class="<?=$this->params['active'] == 'login'? 'active': null?>">
                                    <?php if(Yii::$app->user->isGuest):?>
                                        <a href="<?=Url::to(['/site/login'])?>">Login</a>
                                    <?php else:?>
                                        <a href="<?=Url::to(['/site/logout'])?>" data-method="post">
                                            Logout(<?=Yii::$app->user->identity->username?>)
                                        </a>
                                    <?php endif;?>
                                </li>
                                <!-- End Misc Pages -->

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
            </div>
            <!-- End Navbar -->
        </div>
        <!--=== End Header v3 ===-->
        <?php if(Yii::$app->controller->action->id !== 'login' && Yii::$app->controller->action->id !== 'signup'):?>
            <?php if(isset($this->params['breadcrumbs'])):?>
                <div class="breadcrumbs">
                    <div class="container">
                        <h1 class="pull-left"><?=$this->title?></h1>
                        <?=Breadcrumbs::widget([
                            'options'=>['class'=>'pull-right breadcrumb'],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>
                    </div>
                </div>
            <?php endif;?>
        <?php endif;?>
        <!--===  End Breadcrumb v3 ===-->
        <?= Alert::widget() ?>
        <div class="container content">
            <?=$content?>
        </div>


        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?=Html::a('Apt Inventions Sdn. Bhd.','http://aptinventions.com',['style'=>'text-decoration:none'])?> <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?> </p>
            </div>
        </footer>
    </div>

<?php $this->endBody() ?>
<script type="text/javascript" src="<?=$basicUnify->baseUrl?>/js/custom.js"></script>
<script type="text/javascript" src="<?=$basicUnify->baseUrl?>/js/app.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>

<?php if(isset($this->blocks['JavascriptInit'])):?>
    <?=$this->blocks['JavascriptInit']?>
<?php endif;?>

<!--[if lt IE 9]>
<script src="<?=$basicUnify->baseUrl?>/plugins/respond.js"></script>
<script src="<?=$basicUnify->baseUrl?>/plugins/html5shiv.js"></script>
<script src="<?=$basicUnify->baseUrl?>/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
</body>
</html>
<?php $this->endPage() ?>
