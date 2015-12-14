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
    <link rel="shortcut" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin">


    <?php $this->head() ?>

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/theme-colors/blue.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/custom.css">

</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <!--=== Header v3 ===-->
        <div class="header">
            <div class="container">
                <!-- Logo -->
                <a class="logo" href="index.html">
                    <img id="logo-header" src="<?=$basicUnify->baseUrl?>/img/logo-hybrizy.png" alt="Logo" width="50px" sty>
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
                        <?php if (Yii::$app->user->isGuest):?>
                            <li><a href="<?=Url::to(['/site/login'])?>">Login</a></li>
                        <?php else:?>
                            <li><a href="<?=Url::to(['/site/logout'])?>" data-method="post">Logout: <?= strtoupper(Yii::$app->user->identity->username)?> </a> </li>
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

            <!--=== Navbar  ===-->
            <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
                <div class="container">
                    <?php
                    $menuItems =[
                        ['label' => 'Home', 'url' => ['/site/index']],

//                                    ['label' => 'Executive', 'url' => ['executive/index'],
//                                        'items' => [
//                                            ['label' => 'Dashboard', 'url' => ['dashboard/index']],
//                                            ['label' => 'Report', 'url' => ['report/index']],
//                                        ],
//                                        'options'=>['class'=>'dropdown'],
//                                        'submenuTemplate' =>'<ul class="dropdown-menu">{items}</ul>'
//                                    ],
//                                    ['label' => 'Mentor', 'url' => ['executive/index'],
//                                        'items' => [
//                                            ['label' => 'Personal Info', 'url' => ['dashboard/index']],
//                                            ['label' => 'Business Info', 'url' => ['report/index']],
//                                        ],
//                                        'options'=>['class'=>'dropdown'],
//                                        'submenuTemplate' =>'<ul class="dropdown-menu">{items}</ul>'
//                                    ],
//                                    ['label' => 'Entrepreneur', 'url' => ['site/index'],
//                                        'items' => [
//                                            ['label' => 'Dashboard', 'url' => ['dashboard/index']],
//                                            ['label' => 'Personal Info', 'url' => ['dashboard/index']],
//                                            ['label' => 'Business Info', 'url' => ['report/index']],
//                                        ],
//                                        'options'=>['class'=>'dropdown'],
//                                        'submenuTemplate' =>'<ul class="dropdown-menu">{items}</ul>'
//                                    ],

                    ];

                    if(Yii::$app->user->can('manageAllCampaign') || Yii::$app->user->can('manageCampaign'))
                    {
                        $menuItems[] = [
                            'label' => 'Campaign',
                            'url' => 'javascript:void(0);',
                            'items' => [
                                ['label' => 'Manage Campaign', 'url' => ['/campaign/default/index']],
                            ],
                            'options'=>['class'=>'dropdown'],
                            'submenuTemplate' =>'<ul class="dropdown-menu">{items}</ul>'
                        ];
                    }

//                    if (Yii::$app->user->isGuest) {
//                        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//                        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//                    } else {
//                        $menuItems[] = [
//                            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
//                            'url' => ['/site/logout'],
//                            'template'=>'<a href="{url}" data-method="post">{label}</a>',
//                        ];
//                    }
                    echo \yii\widgets\Menu::widget([
                        'options'=>['class'=>'nav navbar-nav'],
                        'activateParents'=> true,
                        'items' => $menuItems,

                    ]);
                    ?>
                </div>
            </div>

        </div>
        <!--===  Breadcrumb v3 ===-->
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

<?php $this->endBody() ?>
<script>
    jQuery(document).ready(function() {

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
