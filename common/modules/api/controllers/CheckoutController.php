<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/15/15
 * Time: 10:55 AM
 */

namespace common\modules\api\controllers;

use yii\rest\Controller;
use common\models\CartForm;
//use common\models\Package;
//use common\models\Topup;
//use yz\shoppingcart\ShoppingCart;

class CheckoutController extends Controller
{

    public function actionAddPackage($id,$modelClass,$quantity=1)
    {
        $cart = new \common\models\HybrizyCartForm();
        $itemId = $modelClass.'-'.$id;
        $cart->attributes =['id'=>$id,'modelClass'=>$modelClass,'quantity'=>$quantity];
//        $cart->id= $id;
//        $cart->modelClass = $modelClass;
//        $cart->quantity = $quantity;
        $cart->AddToCart();
        $cart->saveSession();
        if(!\Yii::$app->user->isGuest)
            $cart->saveTodb();
        $cartArray = $cart->getResult();
        $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_checkout_item',['value'=>$cartArray['data'],'key'=>$itemId],true);
        return ['html'=>$output,'grandTotal'=>\Yii::$app->formatter->asCurrency($cartArray['grandTotal']), 'subTotal'=>\Yii::$app->formatter->asCurrency($cartArray['grandTotal'])];
    }


    public function actionRemovePackage($id,$modelClass,$quantity=1)
    {
        $cart = new \common\models\HybrizyCartForm();
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
//                $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_checkout_item',['value'=>['totalCount'=>0]],true);
//                return ['html'=>$output,'totalCount'=>0];
                return ['html'=>'','grandTotal'=>0];
            }
        }
        $cart->cart = $cartItems;
        $cart->saveSession();
        if(!\Yii::$app->user->isGuest){
            $cart->saveTodb();
        }
        $cartArray = $cart->getResult();
        $output = \Yii::$app->controller->renderPartial('@frontend/views/site/_checkout_item',['value'=>$cartArray['data'],'key'=>$itemId],true);
        return ['html'=>$output,'grandTotal'=>\Yii::$app->formatter->asCurrency($cartArray['grandTotal']), 'subTotal'=>\Yii::$app->formatter->asCurrency($cartArray['grandTotal'])];
    }


    public function actionRemoveAll()
    {
        $cart = new \common\models\HybrizyCartForm();
        $cartItems = $cart->loadSession('Hybrizy');
        if($cartItems !== false){

        }
    }
    
}