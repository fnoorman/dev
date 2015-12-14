<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/5/15
 * Time: 11:51 PM
 */

$payment = false;
$shipping = false;
?>

<dl class="dl-horizontal" >
    <?php foreach($model->getAttributes(null,['id','user_id','payment_country_id','shipping_country_id','']) as $key=>$value):?>
        <?php
            $temp = explode('_',$key);
            if(count($temp) == 2 && $payment === false)
            {
                if($temp[0] == 'payment')
                {
         ?>
                <div class="headline">
                    <h2>Billing Information</h2>
                </div>
        <?php
                    $payment = true;
                }
            }
            elseif(count($temp) == 2 && $shipping === false)
            {
                if($temp[0] == 'shipping') {
                    $shipping = true;

                    ?>
                    <div class="headline">
                        <h2>Shipping Information</h2>
                    </div>
                    <?php
                }
            }

        ?>
        <dt><strong><?= $model->getAttributeLabel($key) ?> </strong></dt>
        <dd>
            <?=isset($value)?$value:'<span class="label label-danger">NO DATA</span>'?>
        </dd>
        <hr>
    <?php endforeach;?>
</dl>
