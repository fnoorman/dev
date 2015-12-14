<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/11/15
 * Time: 10:38 AM
 */
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?=$content?>
<?php $this->endBody() ?>

<?php if(isset($this->blocks['JavascriptInit'])):?>
    <?=$this->blocks['JavascriptInit']?>
<?php endif;?>
</body>
</html>
<?php $this->endPage() ?>
