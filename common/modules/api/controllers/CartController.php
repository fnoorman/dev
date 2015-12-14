<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/15/15
 * Time: 10:55 AM
 */

namespace common\modules\api\controllers;

use common\models\HybrizyCartForm;
use yii\rest\Controller;
use common\models\Order;
use common\models\OrderForm;
use yii\helpers\Url;


class CartController extends Controller
{

    public function actionAddPackage($id,$modelClass,$quantity=1)
    {
        $cart = new HybrizyCartForm();
        $cart->attributes =['id'=>$id,'modelClass'=>$modelClass,'quantity'=>$quantity];
//        $cart->id= $id;
//        $cart->modelClass = $modelClass;
//        $cart->quantity = $quantity;
        $cart->AddToCart();
        $cart->saveSession();
        if(!\Yii::$app->user->isGuest)
            $cart->saveTodb();
        $cartArray = $cart->getResult();
        $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_cart_list',['items'=>$cartArray],true);
        return ['html'=>$output,'totalCount'=>$cartArray['totalCount']];
    }

    public function actionRemovePackage1($id,$modelClass,$quantity=1)
    {
        $cart = new HybrizyCartForm();
        $cart->attributes =['id'=>$id,'modelClass'=>$modelClass,'quantity'=>$quantity];
        $cart->removeFromSession();
        if(!\Yii::$app->user->isGuest)
            $cart->saveTodb();
        $cartArray = $cart->getResult();
        $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_cart_list',['items'=>$cartArray],true);
        return ['html'=>$output,'totalCount'=>$cartArray['totalCount']];

    }

    public function actionRemovePackage($id,$modelClass,$quantity=1)
    {
        $cart = new HybrizyCartForm();
        $cartItems = $cart->loadSession('Hybrizy');
//        $cartItems = $cart->getResult();
        $itemId = $modelClass.'-'.$id;
        if(array_key_exists($itemId,$cartItems['data'])){
            $item = $cartItems['data'][$itemId];
            $price = $cartItems['data'][$itemId]['price'];
            if($item['count'] == 1){
                $cartItems['totalCount'] = $cartItems['totalCount'] - 1;
                unset($cartItems['data'][$itemId]);
            }
            else
            {
                $item['count'] = $item['count'] - 1;
                $cartItems['data'][$itemId] = $item;
                $cartItems['totalCount'] = $cartItems['totalCount'] - 1;


            }
            if($cartItems['grandTotal'] > 0){
                $cartItems['grandTotal'] = $cartItems['grandTotal'] - $price;
            }
            if(($cartItems['grandTotal'] == 0) && (count($cartItems['data']) == 0)){
                $cart->resetSession();
                if(!\Yii::$app->user->isGuest){
                    $cart->resetUserDb();
                }
                $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_cart_list',['items'=>['totalCount'=>0]],true);
                return ['html'=>$output,'grandTotal'=>0, 'subTotal'=>0];
            }
        }
        $cart->cart = $cartItems;
        $cart->saveSession();
        if(!\Yii::$app->user->isGuest){
            $cart->saveTodb();
        }
        $cartArray = $cart->getResult();
        $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_cart_list',['items'=>$cartArray],true);
        return ['html'=>$output,'totalCount'=>$cartArray['totalCount']];
    }

    public function actionPurchaseNow()
    {
        $MOLPayInfo =[];
        $order = new Order();
        $order->loadDefaultValues();
        $orderForm = new OrderForm();
        $orderForm->load(\Yii::$app->request->post());
        $order->invoice_no = 0;
        $order->invoice_prefix = date("Y-m-d").'-00';;
        $order->store_name = 'Hybrizy';
        $order->payment_method = "MOLPay";
        $order->payment_code = "molpay";
        $order->store_url= Url::base(true);;
        $order->user_id = \Yii::$app->user->id;

        $order->firstname = $orderForm->payment_firstname;
        $order->lastname = $orderForm->payment_lastname;
        $order->email = $orderForm->email;
        $order->telephone = $orderForm->payment_telephone;
        $order->fax = "";
        $order->payment_firstname = $orderForm->payment_firstname;
        $order->payment_lastname = $orderForm->payment_lastname;
        $order->payment_company = "";

        $order->payment_address_1 = $orderForm->payment_address_1;
        $order->payment_address_2 = $orderForm->payment_address_2;
        $order->payment_city = $orderForm->payment_city;
        $order->payment_postcode = $orderForm->payment_postcode;
        $order->payment_country = "";
        $order->payment_zone="";

        $order->payment_address_format ="";

        if($orderForm->BillingInfoAsShippingAddress === '1')
        {
            $order->shipping_firstname = $orderForm->payment_firstname;
            $order->shipping_lastname = $orderForm->payment_lastname;
            $order->shipping_address_1 = $orderForm->payment_address_1;
            $order->shipping_address_2 = $orderForm->payment_address_2;
            $order->shipping_city = $orderForm->payment_city;
            $order->shipping_code = $orderForm->payment_code;
            $order->shipping_postcode = $orderForm->shipping_postcode;

        }
        else
        {
            $order->shipping_firstname = $orderForm->shipping_firstname;
            $order->shipping_lastname = $orderForm->shipping_lastname;
            $order->shipping_address_1 = $orderForm->shipping_address_1;
            $order->shipping_address_2 = $orderForm->shipping_address_2;
            $order->shipping_city = $orderForm->shipping_city;
            $order->shipping_code = $orderForm->shipping_code;
            $order->shipping_postcode = $orderForm->shipping_postcode;
        }

        // MOL Pay info
        $MOLPayInfo['bill_name'] = $order->payment_firstname . ' ' . $order->payment_lastname;
        $MOLPayInfo['bill_desc'] = $orderForm->BillDescription();

        $order->shipping_zone="";
        $order->shipping_address_format="";
        $order->shipping_method="";
        $order->shipping_code="";
        $order->comment="";
        $order->order_status_id;

        $order->currency_code="";
        $order->ip="";
        $order->forwarded_ip="";
        $order->user_agent="";
        $order->accept_language="";
        $order->user_id = \Yii::$app->user->id;
        $cart =  unserialize(\Yii::$app->db->createCommand('select cart from user where id=:id')->bindValue(':id',\Yii::$app->user->id)->queryColumn()[0]);
        $order->total = $cart['grandTotal'];
        if($order->save()){
            $tempOrderId = $order->invoice_prefix.'-'.$order->id;
            $MOLPayInfo['orderid'] = $tempOrderId;
            $MOLPayInfo['amount'] = $order->total;
            $MOLPayInfo['bill_email'] = $order->email;
            $MOLPayInfo['bill_mobile'] = $order->telephone;
            $form = \Yii::$app->controller->renderPartial('@frontend/views/site/_molpay_progress',['model'=>$MOLPayInfo,'merchantId'=>\Yii::$app->params['merchantId']],true);
            return ['data'=>$MOLPayInfo,'result'=>1,'merchantId'=>\Yii::$app->params['merchantId'],'html'=>$form];
        }
        else
        {
            return ['data'=>[],'result'=>0];
        }

    }



    
}