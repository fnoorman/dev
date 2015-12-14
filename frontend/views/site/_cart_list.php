<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/18/15
 * Time: 9:28 PM
 */

use yii\helpers\Url;
?>
<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" id="cart-button">
    <i class="search fa search-btn fa-shopping-cart"></i>
</a>
<?php if($items['totalCount']> 0):?>
    <span class="badge badge-red rounded-x" style="top:7px;right:1px;position: absolute" id="cartTotalCount">
        <?=$items['totalCount']?>
    </span>
<?php endif;?>
<?php if($items['totalCount']> 0):?>
    <ul class="dropdown-menu" id="my-cart">


    <?php foreach($items['data'] as $key => $value):?>
    <li >
        <div class="row margin-left-10">
            <div class="col-lg-10">
                <h4>
                    <?=$value['name']?>:  Qty [<?=$value['count']?>]
                </h4>
                <p>
                <h5>
                    <?php foreach($value['details'] as $detail):?>
                        <?=$detail?>
                    <?php endforeach;?>
                </h5>
                </p>

            </div>

            <div class="col-lg-2">
                <button class="btn-u btn-u-red pull-right" type="button" onclick="removePackage('<?=$key?>')"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>
    </li>
    <?php endforeach;?>

    <li >
        <div class="row margin-left-10">
            <div class="col-lg-6">
                <a href="<?=Url::to(['/site/checkout'])?>" class="btn btn-success" style="margin-top: 5px ">
                    Checkout Now !
                </a>
            </div>
            <div class="col-lg-6">
                <h5 class="pull-right" style="border-top: 2px dotted #888;padding-top: 5px;border-bottom: 2px dotted #888;padding-bottom: 5px;padding-right:5px">Grand Total <b>RM <?=$items['grandTotal']?> </b></h5>
            </div>
        </div>

    </li>
</ul>
<?php endif;?>