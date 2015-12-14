<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/16/15
 * Time: 11:49 AM
 */
use yii\helpers\Url;
use yii\helpers\Html;
use Yii;


$this->params['page_body_prop'] = ['id'=>'body', 'class'=>'header-fixed'];
?>
<div class="wrapper">
    <div class="breadcrumbs-v4" style="background-image: url(/img/sliders/revolution/top-cart.jpg)">
        <div class="container">
            <span class="page-name">Check Out</span>
            <h1>Maecenas <span class="shop-green">enim</span> sapien</h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?=Url::base(true)?>/#body">Home</a></li>
                <li><a href="<?=Url::base(true)?>/#packages">Packages</a></li>
                <li class="active">Shopping Cart</li>
            </ul>
        </div><!--/end container-->
    </div>

    <!--=== Content Medium Part ===-->
    <div class="content-md margin-bottom-30">
        <div class="container">
            <?= Html::beginForm(Url::base(true).'/api/cart/purchase-now','post',['id'=>'cart-checkout','class'=>'shopping-cart'])?>
                <div>
                    <div class="header-tags">
                        <div class="overflow-h">
                            <h2>Shopping Cart</h2>
                            <p>Review &amp; edit your product</p>
                            <i class="rounded-x fa fa-check"></i>
                        </div>
                    </div>
                    <section>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cart['data'] as $key => $value):?>
                                <tr id="<?=$key?>">
                                    <td class="product-in-table">
                                        <div class="product-it-in" style="margin-top: 0">
                                            <h3><?=$value['name']?></h3>
                                            <?php foreach($value['details'] as $detail):?>
                                                <?=$detail?>
                                            <?php endforeach;?>
                                        </div>
                                    </td>
                                    <td><?=Yii::$app->formatter->asCurrency($value['price'])?></td>
                                    <td>
                                        <?php if($value['price'] !== '0.00'):?>
                                            <button type='button' class="quantity-button" name='subtract' onclick="removePackage('<?=$key?>')">-</button>
                                            <input type='text' class="quantity-field" name='qty1' value="<?=$value['count']?>" id='qty1'/>
                                            <button type='button' class="quantity-button" name='add' onclick="AddToCart('<?=$key?>')" value='+'>+</button>
                                        <?php endif;?>
                                    </td>
                                    <td class="shop-red">$ <?= Yii::$app->formatter->asDecimal($value['price'] * $value['count'])?></td>
                                    <td>
                                        <button type="button" class="close" onclick="removeAll('<?=$key?>')"><span>&times;</span><span class="sr-only">Close</span></button>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <div class="header-tags">
                        <div class="overflow-h">
                            <h2>Billing info</h2>
                            <p>Shipping and address infot</p>
                            <i class="rounded-x fa fa-home"></i>
                        </div>
                    </div>
                    <section class="billing-info">
                        <div class="row">
                            <div class="col-md-6 md-margin-bottom-40">
                                <h2 class="title-type">Billing Address</h2>
                                <div class="billing-info-inputs checkbox-list">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'payment_firstname',['class'=>'form-control required'])?>
                                            <?=Html::activeInput('text',$profile,'email',['class'=>'form-control required'])?>
<!--                                            <input id="name" type="text" placeholder="First Name" name="firstname" class="form-control required">-->
<!--                                            <input id="email" type="text" placeholder="Email" name="email" class="form-control required email">-->
                                        </div>
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'payment_lastname',['class'=>'form-control required'])?>
                                            <?=Html::activeInput('tel',$profile,'payment_telephone',['class'=>'form-control required','id'=>'phone','placeholder'=>'Phone/Mobile'])?>

<!--                                            <input id="surname" type="text" placeholder="Last Name" name="lastname" class="form-control required">-->
<!--                                            <input id="phone" type="tel" placeholder="Phone" name="phone" class="form-control required">-->
                                        </div>
                                    </div>
                                    <?=Html::activeInput('text',$profile,'payment_address_1',['class'=>'form-control required'])?>
                                    <?=Html::activeInput('text',$profile,'payment_address_2',['class'=>'form-control required'])?>
<!--                                    <input id="billingAddress" type="text" placeholder="Address Line 1" name="address1" class="form-control required">-->
<!--                                    <input id="billingAddress2" type="text" placeholder="Address Line 2" name="address2" class="form-control required">-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'payment_city',['class'=>'form-control required','placeholder'=>'City'])?>


<!--                                            <input id="city" type="text" placeholder="City" name="city" class="form-control required">-->
                                        </div>
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'payment_postcode',['class'=>'form-control required','placeholder'=>'Zip/Postal Code'])?>
<!--                                            <input id="zip" type="text" placeholder="Zip/Postal Code" name="zip" class="form-control required">-->
                                        </div>
                                    </div>

                                    <label class="checkbox text-left">
                                        <?=Html::activeCheckbox($profile,'BillingInfoAsShippingAddress',['label'=>null])?>
<!--                                        <input type="checkbox" name="checkbox"/>-->
                                        <i></i>
                                        Ship item to the above billing address
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6" style="display:none">
                                <h2 class="title-type">Shipping Address</h2>
                                <div class="billing-info-inputs checkbox-list">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'shipping_firstname',['class'=>'form-control ','placeholder'=>'First Name'])?>
<!--                                            <input id="name2" type="text" placeholder="First Name" name="firstname" class="form-control">-->
                                            <?=Html::activeInput('text',$profile,'email',['class'=>'form-control '])?>
<!--                                            <input id="email2" type="text" placeholder="Email" name="email" class="form-control email">-->
                                        </div>
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'shipping_lastname',['class'=>'form-control ','placeholder'=>'Last Name'])?>
                                            <?=Html::activeInput('tel',$profile,'shipping_telephone',['class'=>'form-control ','id'=>'phone','placeholder'=>'Phone/Mobile'])?>
<!--                                            <input id="surname2" type="text" placeholder="Last Name" name="lastname" class="form-control">-->

<!--                                            <input id="phone2" type="tel" placeholder="Phone" name="phone" class="form-control">-->
                                        </div>
                                    </div>
                                    <?=Html::activeInput('text',$profile,'shipping_address_1',['class'=>'form-control '])?>
                                    <?=Html::activeInput('text',$profile,'shipping_address_2',['class'=>'form-control '])?>
<!--                                    <input id="shippingAddress" type="text" placeholder="Address Line 1" name="address1" class="form-control">-->
<!--                                    <input id="shippingAddress2" type="text" placeholder="Address Line 2" name="address2" class="form-control">-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'shipping_city',['class'=>'form-control ','placeholder'=>'City'])?>
<!--                                            <input id="city2" type="text" placeholder="City" name="city" class="form-control">-->
                                        </div>
                                        <div class="col-sm-6">
                                            <?=Html::activeInput('text',$profile,'shipping_postcode',['class'=>'form-control ','placeholder'=>'Zip/Postal Code'])?>
<!--                                            <input id="zip2" type="text" placeholder="Zip/Postal Code" name="zip" class="form-control">-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <div class="coupon-code">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-5 pull-right">
                                <ul class="list-inline total-result">
                                    <li>
                                        <h4>Subtotal:</h4>
                                        <div class="total-result-in">
                                            <span id="subTotal"><?=Yii::$app->formatter->asCurrency($cart['grandTotal'])?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>Shipping:</h4>
                                        <div class="total-result-in">
                                            <span class="text-right">- - - -</span>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="total-price">
                                        <h4>Total:</h4>
                                        <div class="total-result-in">
                                            <span id="grandTotal"><?=Yii::$app->formatter->asCurrency($cart['grandTotal'])?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/end container-->
    </div>
    <!--=== End Content Medium Part ===-->

</div>

<div id="molpay-section" style=""display:none">

</div>
<?php $this->beginBlock('JavascriptInit'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        StepWizard.initStepWizard();
        $('form').find('div.row #phone').each(function() {
            $(this).mask('(999) 999-9999', {placeholder:'X'});
            console.log('done masking');
        });

    });



</script>

<script type="text/javascript">

    function removePackage(info)
    {
        var a = info.split("-"); // info : Package-{id} or Topup-{id}
        var packageId = a[1];
        $.ajax({
            method: "GET",
            url: "<?=Url::base(true)?>/api/checkout/remove-package?id="+packageId + '&modelClass=' + a[0],
        }).done(function( result ){
            console.log(result.html);
            var cart = document.getElementById(info);
            var grandTotal = document.getElementById('grandTotal');
            var subTotal = document.getElementById('subTotal');
            cart.innerHTML = '';
            cart.innerHTML = result.html;
            grandTotal.textContent = result.grandTotal;
            subTotal.textContent = result.subTotal;
        });
    }

    function AddToCart(info)
    {
        var a = info.split("-"); // info : Package-{id} or Topup-{id}
        var packageId = a[1];

        $.ajax({
            method: "GET",
            url: "<?=Url::base(true)?>/api/checkout/add-package?id="+packageId + '&modelClass=' + a[0],
        }).done(function( result ){
            console.log(result.html);
            var cart = document.getElementById(info);
            var grandTotal = document.getElementById('grandTotal');
            var subTotal = document.getElementById('subTotal');
            cart.innerHTML = '';
            cart.innerHTML = result.html;
            grandTotal.textContent = result.grandTotal;
            subTotal.textContent = result.subTotal;

        });
    }

    function removeAll(info){
        alert(info);
    }

</script>
<?php $this->endBlock(); ?>



