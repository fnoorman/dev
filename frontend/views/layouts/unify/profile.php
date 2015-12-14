<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/theme-colors/blue.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?=$basicUnify->baseUrl?>/css/custom.css">

</head>
<body class="header-fixed">
<?php $this->beginBody() ?>
    <div class="wrapper">

        <?=$content?>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?=Html::a('Apt Inventions Sdn. Bhd.','http://aptinventions.com',['style'=>'text-decoration:none'])?> <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?> </p>
            </div>
        </footer>
    </div>

<?php $this->endBody() ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initScrollBar();
//        Datepicker.initDatepicker();
//
    });
</script>

<?php if (isset($this->blocks['JavascriptInit'])): ?>
    <?= $this->blocks['JavascriptInit'] ?>
<?php endif; ?>

</body>
</html>
<?php $this->endPage() ?>
