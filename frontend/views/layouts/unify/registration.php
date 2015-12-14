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
<?php $this->beginContent('@frontend/views/layouts/unify/front_page.php');?>
<div class="wrapper">
    <!--=== Header ===-->
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="<?=$urlBase->baseUrl?>/img/logo-hybrizy.png" alt="Logo" width="50px">
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
                    <?php if(Yii::$app->controller->action->id ==='signup'):?>
                        <li><a href="<?=Url::to(['/site/login'])?>">Login</a></li>
                    <?php else:?>
                        <li><a href="<?=Url::to(['/site/signup'])?>">Signup</a></li>
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
                    <li >
                        <a href="<?=Url::to(['/site/landing'])?>">
                            Home
                        </a>
                    </li>
                    <!-- End Home -->

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
    <div class="container content">
        <div class="row">
            <?=$content?>
        </div>
    </div>
    <!--=== End Content ===-->
</div>


<?php $this->endContent();?>


