<?php

/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/20/15
 * Time: 7:49 PM
 */


?>

<div class="panel panel-default margin-bottom-40">
    <div class="panel-heading">
        <h3 class="panel-title">Product Details</h3>
    </div>
    <div class="panel-body">

    </div>
    <table class="table table-striped invoice-table">
        <thead>
        <tr>

            <th>Item</th>
            <th class="hidden-sm">Description</th>
            <th>Quantity</th>

            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            <?php if(isset($cart['data'])):?>
            <?php foreach($cart['data'] as $key=>$value):?>
            <tr>

                <td><?=$value['name']?></td>
                <td class="hidden-sm"><?=implode(" ",$value['details'])?></td>
                <td><?=$value['count']?></td>

                <td><?=\Yii::$app->formatter->asCurrency($value['price'])?></td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>
<div class="row invoice-info">
    <div class="col-xs-6">
        <div class="tag-box tag-box-v3">
            <div class="headline">
                <h2>Grand Total</h2>
            </div>

            <ul class="list-unstyled">
                <li><strong>Subtotal : </strong> <?=Yii::$app->formatter->asCurrency($cart['grandTotal'])?></li>
                <li><strong>Shipping :</strong> RM 0.00</li>
                <li><strong>Discount :</strong> RM 0.00</li>
                <li style="border-top: 2px solid">
                    <h3>
                        <strong>Total    :</strong>
                    <?=Yii::$app->formatter->asCurrency($cart['grandTotal'])?></h3>
                </li>
            </ul>
        </div>
    </div>

</div>