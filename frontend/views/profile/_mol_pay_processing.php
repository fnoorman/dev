<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/22/15
 * Time: 1:40 PM
 */

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12" style="text-align: center">
        <p>
            <h4 class="text-primary">Click PayNow to select any of the payment method below:</h4>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="text-align: center">
        <?=Html::img(Url::base(true).'/img/molpay-logo-400x160.png')?>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="text-align: center">
        <?=$form?>
    </div>
</div>

<br>
<br>


<?php $this->beginBlock('JavascriptInit')?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#MOLPayStep').click(function () {
            $('#MOLPayBtn').trigger('click');
        })
    });
</script>

<?php $this->endBlock();?>


