<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/5/15
 * Time: 11:51 PM
 */

use yii\widgets\DetailView;

$attributes = $model->getAttributes(null,['user_id','payment_country_id','payment_company_id']);
$info = [];
$billing = [];
$shipping = [];
$key_attributes = array_keys($attributes);
foreach($key_attributes as $key)
{
    if(strpos($key,'payment_') !== false)
    {
        $billing[] = $key;
    }
    elseif(strpos($key,'shipping_') !== false)
    {
        $shipping[] = $key;
    }
    else
    {
        if(strpos($key,'created_at') !== false || strpos($key,'updated_at') !== false)
        {
            $info[] = $key.':datetime';
        }
        elseif(strpos($key,'created_by') !== false)
        {
            $info[] = 'createByName';
        }
        elseif(strpos($key,'updated_by') !== false)
        {
            $info[] = 'updateByName';
        }
        else
            $info[] = $key;
    }
}

?>

<div class="headline">
    <h2>Profile Information</h2>
</div>
<?= DetailView::widget(
    [
        'model' => $model,
        'template'=>'<dt>{label}</dt><dd>{value}</dd><hr>',
        'options'=>['tag'=>'dl','class'=>'dl-horizontal'],
        'attributes' =>$info,
    ]
)?>
<div class="headline">
    <h2>Billing Information</h2>
</div>
<?= DetailView::widget(
    [
        'model' => $model,
        'template'=>'<dt>{label}</dt><dd>{value}</dd><hr>',
        'options'=>['tag'=>'dl','class'=>'dl-horizontal'],
        'attributes' =>$billing,
    ]
)?>
<div class="headline">
    <h2>Shipping Information</h2>
</div>
<?= DetailView::widget(
    [
        'model' => $model,
        'template'=>'<dt>{label}</dt><dd>{value}</dd><hr>',
        'options'=>['tag'=>'dl','class'=>'dl-horizontal'],
        'attributes' =>$shipping,
    ]
)?>


