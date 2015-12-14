<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\assets\BaseUnifyAsset;

use common\widgets\Alert;

$basicUnify = BaseUnifyAsset::register($this);
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
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
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

            </div>
            <!-- End Container -->
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
                        <?php if(!Yii::$app->user->isGuest):?>
                            <!-- Authorization -->
                            <?php if(Yii::$app->user->can('manageAuthorization')):?>
                                <li class="dropdown <?= in_array('authorization', $this->params['active']) ? 'active': null?>">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                        Authorization
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="<?=in_array('role',$this->params['active'])? 'active': null?>">
                                            <a href="<?=Url::to(['/authorization/index','type'=>1])?>">
                                                Role
                                            </a>
                                        </li>

                                        <li class="<?=in_array('permission',$this->params['active'])? 'active': null?>">
                                            <a href="<?=Url::to(['/authorization/index','type'=>2])?>">Permission</a>
                                        </li>
                                        <!--?php endif;?-->
                                    </ul>
                                </li>
                            <?php endif;?>
                            <!-- End Authorization -->
                        <?php endif;?>
                    </ul>
                </div>
            </div>

        </div>
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
        <?= Alert::widget() ?>
        <br>
        <div class="container content-profile">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-body">
                        <?=$content?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endBody() ?>
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
