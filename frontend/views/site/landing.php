<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/11/15
 * Time: 10:38 AM
 */

/* @var $this \yii\web\View */
use common\assets\OnePageUnifyAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Lookup;
use common\widgets\Alert;
use frontend\assets\YiiLandingAsset;
$urlBase = OnePageUnifyAsset::register($this);
YiiLandingAsset::register($this);
?>

<!--=== Header ===-->
<nav class="one-page-header navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="menu-container page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#intro" style="padding-top: 0">
<!--                <span>U</span>nify-->

                 <img src="<?=Url::base(true)?>/img/logo-hybrizy.png" alt="Logo" width="50px">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <div class="menu-container">
                <ul class="nav navbar-nav">
                    <li class="page-scroll home">
                        <a href="#intro">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About Us</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#packages">Packages</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#gallery">Gallery</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact Us</a>
                    </li>
                        <?php if(!Yii::$app->user->isGuest):?>
                            <li class="page-scroll">
                                <?=Html::a('Profile',['/profile/setting'])?>
                            </li>
                            <li class="page-scroll">
                                <?=Html::a('Logout('.Yii::$app->user->identity->username.')',['/site/logout'],['data-method'=>'post'])?>
                            </li>
                        <?php else:?>
                            <li class="page-scroll">
                                <a href="<?=Url::to(['/site/signup'])?>">Sign Up</a>
                            </li>
                            <li class="page-scroll">
                                <a href="<?=Url::to(['/site/login'])?>">Login</a>
                            </li>
                        <?php endif;?>
                    <style>
                        @media screen
                        and (min-device-width: 768px)
                        {

                            #my-cart.dropdown-menu{
                                margin-left: -350px;
                                width:400px;
                            }
                        }

                        .one-page-header.top-nav-collapse .dropdown-menu > li > div > div > h4 {
                            color: #777;
                        }

                        .one-page-header.top-nav-collapse .dropdown-menu > li > div > div > h5 {
                            color: #777;
                        }

                        .one-page-header .dropdown-menu > li > div > div > h4 {
                            color: #fff;
                        }
                        .one-page-header .dropdown-menu > li > div > div > h5 {
                            color: #fff;
                        }


                    </style>
                    <li class="dropdown" id="cart-list">
                        <?=Yii::$app->controller->renderPartial('@frontend/views/site/_cart_list',['items'=>$cart])?>

                    </li>

                </ul>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!--=== End Header ===-->
<!-- Intro Section -->
<section id="intro" class="intro-section">
    <div class="fullscreenbanner-container">
        <div class="fullscreenbanner">
            <ul>
                <!-- SLIDE 1 -->
                <li data-transition="curtain-1" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                    <!-- MAIN IMAGE -->
                    <img src="<?=$urlBase->baseUrl?>/img/sliders/revolution/slide-1.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                </li>

                <!-- SLIDE 2 -->
                <li data-transition="slideup" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
                    <!-- MAIN IMAGE -->
                    <img src="<?=$urlBase->baseUrl?>/img/sliders/revolution/slide-2.jpg" alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                </li>

                <!-- SLIDE 3 -->
                <li data-transition="slideup" data-slotamount="5" data-masterspeed="700"  data-title="Slide 3">
                    <!-- MAIN IMAGE -->
                    <img src="<?=$urlBase->baseUrl?>/img/sliders/revolution/slide-3.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">

                </li>
            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
            <div class="tp-dottedoverlay twoxtwo"></div>
        </div>
    </div>
</section>
<!-- End Intro Section -->

<!--  About Section -->
<section id="about" class="about-section section-first">
    <div class="block-v1">
        <div class="container">
            <div class="title-v1">
                <h1>We are Unify Agency</h1>
                <p>
                    <strong class="color-blue">Hybrizy</strong> is a new web and mobile application that combine both <strong class="color-blue">physical</strong> and <strong class="color-blue">digital</strong> contents by using pre-generated <strong class="color-blue">code</strong>.
                    <br>
                    In simpler words, <strong class="color-blue">Hybrizy</strong> is your <strong class="color-blue">one-code-solution</strong> to your new and improvised paper products.
                </p>

            </div>
            <div class="row content-boxes-v3">
                <div class="col-md-4 md-margin-bottom-30">
                    <i class="icon-custom rounded-x icon-bg-dark fa fa-print"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm">Printed Agencies</h2>
                        <p>A key to elevate your printed materials into a new level. <strong class="color-blue">Hybrizy</strong> promotes a new type of combination reading that aids readers in experiencing enhanced reading.</p>
                    </div>
                </div>
                <div class="col-md-4 md-margin-bottom-30">
                    <i class="icon-custom rounded-x icon-bg-dark fa fa-university"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm">ELECTRONIC INDUSTRY</h2>
                        <p><strong class="color-blue">Hybrizy</strong> can provide the answer to your dilemma by using this tiny code to store all your visual adaptation.
                            Any contests or even music videos can be stored into this tiny <strong class="color-blue">code</strong>.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <i class="icon-custom rounded-x icon-bg-dark fa fa-user"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm">Individuals</h2>
                        <p><strong class="color-blue">Hybrizy</strong> is your key in creating a cutting edge document storage experience. You can customize on what you want people to find in the <strong class="color-blue">Hybrizy code</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-image" style="background-color: #7bd8ff;">
        <div class="container">
            <div class="title-v1">
                <h1>MERGING PAPER AND DIGITAL WITH EASE</h1>
                <p>
                    <strong>Hybrizy</strong> lets you spice up your <strong>plain old text-on-paper</strong> by adding value to your print products.
                    <strong>Hybrizy</strong> can solve your dilemma by providing a <strong>code</strong> that promises <strong>awesome</strong> feedback from your customers and audiences.
                </p>
            </div>
            <div class="img-center">
                <img class="img-responsive" src="<?=Url::base(true)?>/img/about-us.png" alt="">
            </div>
        </div>
    </div>


    <div class="container content-lg">
        <div class="title-v1">
            <h2>Our Vision And Mission</h2>
            <p>
                Brings new <strong>Innovation Perspective</strong> to printing media in the new age.
            </p>
        </div>

        <div class="row">
            <div class="col-md-6 content-boxes-v3 margin-bottom-40">
                <div class="clearfix margin-bottom-30" style="background-color: #7bd8ff;padding-left: 10px;padding-top: 10px;">
                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm">NEW APPROACH & SOLUTION</h2>
                        <p><strong>Hybrizy</strong> is the new and innovative web and mobile application that makes ordinary paper products become extra-ordinary.</p>
                    </div>
                </div>
                <div class="clearfix margin-bottom-30" style="background-color: #17607f;padding-left: 10px;padding-top: 10px;">
                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-directions"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm" style="color:#fff">EASE OF ACCESSIBILITIES</h2>
                        <p style="color: #fff">
                            Provide multiple platform for mobiles, tablets and PC's. So you can access it anywhere and anytime by using a specific code.
                        </p>
                    </div>
                </div>
                <div class="clearfix margin-bottom-30">
                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-note"></i>
                    <div class="content-boxes-in-v3">
                        <h2 class="heading-sm">CUSTOMIZE CONTENT</h2>
                        <p>It can be anything such as campaigns, products, contests and etc according to your own creativity</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img class="img-responsive" src="<?=Url::base(true)?>/img/about-us-2.png" alt="">
            </div>
        </div>
    </div>

    <style type="text/css">
        .parallax-quote {
            padding: 30px 0;
            background: rgba(0,0,0,0.8);
        }
        .parallax-quote:after {
            background: rgba(0,0,0,0.2);
        }
    </style>

    <div class="parallax-quote parallaxBg" style="background-color: rgb(23, 96, 127); background-position: 50% -51px;">
        <div class="container">
            <div class="parallax-quote-in">
                <p>We do not simplify things but we give something <br>more manageable.</p>
                <small>- Hybrizy -</small>
            </div>
        </div>
    </div>

</section>
<!--  About Section -->

<!--  Package Section -->
<section id="packages">
    <div class="container content-lg">
        <?=Alert::widget()?>
        <div class="title-v1">
            <h2>Hybrizy Packages &amp; Pricing</h2>
            <p>You can choose the packages that suit your needs.<br>
                Each package contain different features.</p>
        </div>
        <style>
            .pricing:hover h4{
                color: #555;
            }
        </style>
        <!-- loop packages -->
        <div class="row margin-bottom-20 pricing-dark">
            <?php foreach($packages as $package) :?>
                <div class="col-lg-3">
                    <?=Yii::$app->controller->renderPartial('@backend/views/package/_template',['model'=>$package])?>
                </div>
            <?php endforeach;?>
        </div>
        <!-- End loop packages -->
        <div class="title-v1">
            <p><b><i>* Every Purchase(s) Are Not Refundable.</i></b></p>
        </div>

        <div class="title-v1">
            <h2>Call-out Packages &amp; Pricing</h2>
            <p>
                You can choose the call-out packages to top-pup your call-outs.<br>
            </p>
        </div>
        <div class="row">
            <?php
                $current = 1;
            ?>
            <?php foreach($toppups as $topup):?>
                <?php
                    $backgroundColor = (($current % 2) === 0)? '#29abe2': '#17607f';
                ?>

                <div class="col-md-3 col-sm-6">
                    <?=Yii::$app->controller->renderPartial('@backend/views/topup/_template',['model'=>$topup,'backgroundColor'=>$backgroundColor])?>
                </div>
                <?php
                    $current++;
                ?>
            <?php endforeach;?>
        </div>
    </div>
</section>
<!--  End Package Section -->

<!-- Gallery Section -->
<section id="gallery" class="about-section">
    <div class="container content-lg" style="padding-top:30px;">
        <div class="title-v1">
            <h2>Our Gallery</h2>
            <p>We do <strong>things</strong> differently company providing key digital services. <br>
                Focused on helping our clients to build a <strong>successful</strong> business on web and mobile.</p>
        </div>

        <div class="cube-portfolio">
            <!-- <div id="filters-container" class="cbp-l-filters-button">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All </div>
                <div data-filter=".print" class="cbp-filter-item"> Print </div>
                <div data-filter=".web-design" class="cbp-filter-item"> Web Design </div>
                <div data-filter=".motion" class="cbp-filter-item"> Motion </div>
            </div> --><!--/end Filters Container-->

            <div id="grid-container" class="cbp-l-grid-gallery">
                <div class="cbp-item print motion">
                    <!-- <a href="unify/assets/ajax/project1.html" class="cbp-caption cbp-singlePageInline"
                       data-title="World Clock Widget<br>by Paul Flavius Nechita"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY01.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">World Clock Widget</div>
                                <div class="cbp-l-caption-desc">by Paul Flavius Nechita</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item web-design">
                    <!-- <a href="unify/assets/ajax/project2.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Bolt UI<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY02.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">Bolt UI</div>
                                <div class="cbp-l-caption-desc">by Tiberiu Neamu</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item print motion">
                    <!-- <a href="unify/assets/ajax/project3.html" class="cbp-caption cbp-singlePageInline"
                       data-title="WhereTO App<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY03.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">WhereTO App</div>
                                <div class="cbp-l-caption-desc">by Tiberiu Neamu</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item web-design print">
                    <!-- <a href="unify/assets/ajax/project4.html" class="cbp-caption cbp-singlePageInline"
                       data-title="iDevices<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY04.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">iDevices</div>
                                <div class="cbp-l-caption-desc">by Tiberiu Neamu</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item motion">
                    <!-- <a href="unify/assets/ajax/project5.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Seemple* Music for iPad<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY05.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">Seemple* Music for iPad</div>
                                <div class="cbp-l-caption-desc">by Tiberiu Neamu</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item print motion">
                    <!-- <a href="unify/assets/ajax/project6.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Remind~Me Widget<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY06.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">Remind~Me Widget</div>
                                <div class="cbp-l-caption-desc">by Tiberiu Neamu</div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item web-design print">
                    <!-- <a href="unify/assets/ajax/project7.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Workout Buddy<br>by Tiberiu Neamu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY07.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title"></div>
                                <div class="cbp-l-caption-desc"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item print">
                    <!-- <a href="unify/assets/ajax/project8.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Digital Menu<br>by Cosmin Capitanu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY08.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title"></div>
                                <div class="cbp-l-caption-desc"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="cbp-item motion">
                    <!-- <a href="unify/assets/ajax/project9.html" class="cbp-caption cbp-singlePageInline"
                       data-title="Holiday Selector<br>by Cosmin Capitanu"> -->
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?=$urlBase->baseUrl?>/img/portfolio/HYBRIZY09.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignLeft">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title"></div>
                                <div class="cbp-l-caption-desc"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .clients-section {
            background: #29abe2;
        }
        .clients-section:after {
            background: rgba(0,0,0,0.5);
        }
    </style>

    <!--Media Queries iphone 5-->
    <style type="text/css">
        @media only screen and (min-device-width: 320px) and (max-device-width: 568px){
            .owl-clients-v2{
                margin-left: -40px;
            }
        }
    </style>
    <div class="clients-section parallaxBg">
        <div class="container">
            <div class="title-v1">
                <h2>Our Clients</h2>
            </div>
            <ul class="owl-clients-v2" style="padding-left:29%;">
                <!-- <li class="item"><a href="#"><img src="unify/assets/img/clients/jkr_edit2.png" alt=""></a></li>
                <li class="item"><a href="#"><img src="unify/assets/img/clients/bekazon_edit.png" alt=""></a></li> -->
                <li class="item"><a href="#"><img src="<?=$urlBase->baseUrl?>/img/clients/MOY.png" alt=""></a></li>
                <!-- <li class="item"><a href="#"><img src="unify/assets/img/clients/jpj_edit2.png" alt=""></a></li> -->
                <li class="item"><a href="#"><img src="<?=$urlBase->baseUrl?>/img/clients/ujang_edit2.png" alt=""></a></li>
                <li class="item"><a href="#"><img src="<?=$urlBase->baseUrl?>/img/clients/apo_edit.png" alt=""></a></li>
                <!-- <li class="item"><a href="#"><img src="unify/assets/img/clients/kesihatan_edit3.png" alt=""></a></li>
                <li class="item"><a href="#"><img src="unify/assets/img/clients/odosys_edit.png" alt=""></a></li>
                <li class="item"><a href="#"><img src="unify/assets/img/clients/fms_edit.png" alt=""></a></li> -->
            </ul>
        </div>
    </div>
</section>
<!-- End Gallery Section -->
<?php $this->beginBlock('JavascriptInit')?>
<script type="text/javascript">
    $(document).ready(function(){
        App.init();
        App.initCounter();
        App.initParallaxBg();
        OwlCarousel.initOwlCarousel();
        RevolutionSlider.initRSfullScreen();

    });
</script>

<script type="text/javascript">

    function removePackage(info)
    {
        var a = info.split("-"); // info : Package-{id} or Topup-{id}
        var packageId = a[1];
        $.ajax({
            method: "GET",
            url: "<?=Url::base(true)?>/api/cart/remove-package?id="+packageId + '&modelClass=' + a[0],
        }).done(function( result ){
            console.log(result.html);
            var cart = document.getElementById('cart-list');
            cart.innerHTML = '';
            cart.innerHTML = result.html;
        });
    }

    function AddToCart(info)
    {
        var a = info.split("-"); // info : Package-{id} or Topup-{id}
        var packageId = a[1];

        $.ajax({
            method: "GET",
            url: "<?=Url::base(true)?>/api/cart/add-package?id="+packageId + '&modelClass=' + a[0],
        }).done(function( result ){
            console.log(result.html);
            var cart = document.getElementById('cart-list');
            cart.innerHTML = '';
            cart.innerHTML = result.html;
        });
    }

</script>

<?php $this->endBlock();?>
