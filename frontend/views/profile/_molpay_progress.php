<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/29/15
 * Time: 12:05 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php echo Html::beginForm('https://www.onlinepayment.com.my/MOLPay/pay/'.Yii::$app->params['merchantID'].'/','post',['id'=>'molpay-form']); ?>
<input type="hidden" name="bill_name" value="<?php echo $model['bill_name']?>">
<input type="hidden" name="bill_desc" value="<?php echo $model['bill_desc'] ?>">
<input type="hidden" name="orderid" value="<?php echo $model['orderid'] ?>">
<input type="hidden" name="amount" value="<?php echo $model['amount'] ?>">
<input type="hidden" name="bill_mobile" value="<?php echo $model['bill_mobile'] ?>">
<input type="hidden" name="bill_email" value="<?php echo $model['bill_email'] ?>">
<input type="hidden" name="currency" value="<?php echo $model['currency'] ?>">
<input type="hidden" name="country" value="<?php echo $model['country'] ?>">
<input type="hidden" name="vcode" value="<?php echo $model['vcode'] ?>">
<input type=hidden name= 'returnurl' value='<?=Url::base(true)?>/profile/molpay-response'>

<?=Html::submitButton('Pay',['class'=>'hidden','id'=>'MOLPayBtn'])?>

<?php echo Html::endForm(); ?>


