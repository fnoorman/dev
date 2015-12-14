<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/15/15
 * Time: 12:02 AM
 */

use common\assets\ShopUIUnifyAsset;
use yii\helpers\Html;

$custom = ShopUIUnifyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Check Out | Unify - Responsive Website Template</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/css/shop.style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/css/headers/header-v5.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/css/footers/footer-v4.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/animate.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/jquery-steps/css/custom-jquery.steps.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <?php $this->head() ?>

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?=$custom->baseUrl?>/Shop-UI/assets/css/custom.css">

</head>

<body <?php echo implode(' ', array_map(function($prop, $value) {
    return $prop.'="'.$value.'"';
}, array_keys($this->params['page_body_prop']), $this->params['page_body_prop'])) ;?>>

<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/back-to-top.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/smoothScroll.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/jquery-steps/build/jquery.steps.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!-- JS Customization -->
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/js/custom.js"></script>

<!-- JS Page Level -->
<!--<script src="--><!--?//=$custom->baseUrl?><!--/Shop-UI/assets/js/shop.app.js"></script>-->
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/js/plugins/stepWizard.js"></script>

<?php if(isset($this->blocks['JavascriptInit'])):?>
    <?=$this->blocks['JavascriptInit']?>
<?php endif;?>

<!--[if lt IE 9]>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/respond.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/html5shiv.js"></script>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<script src="<?=$custom->baseUrl?>/Shop-UI/assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->
</body>

</html>
<?php $this->endPage() ?>
