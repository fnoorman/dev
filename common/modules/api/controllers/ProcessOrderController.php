<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/20/15
 * Time: 1:01 PM
 */

/* @var $op common\models\OrderProduct */
/* @var $package common\models\Package */

namespace common\modules\api\controllers;

use common\models\CodeBank;
use common\models\CodeMember;
use common\models\OrderProduct;
use common\models\Package;
use common\models\TopupBank;
use yii\rest\Controller;
use Yii;

class ProcessOrderController extends Controller
{
    public function actionProcess($objectId,$modelClass,$orderId)
    {
        $package = Package::findOne($objectId);
        $op = new OrderProduct();
        $op->modelClass = $modelClass;
        $op->objectId = $objectId;
        $op->name = $package->name;
        $op->order_id = $orderId;
        $op->mask = $package->mask;
        if($op->save())
        {
            if($modelClass === 'Package')
                return $this->createCodeBank($package->duration,$op->id,$package->maxCallOut,$package->minBalance);
            elseif($modelClass == 'Topup')
            {
                return $this->createTopupBank($op->id);
            }
        }
        return false;
    }

    public function createTopupBank($order_product_id)
    {
        $tp = new TopupBank();
        $tp->loadDefaultValues();
        $tp->order_product_id = $order_product_id;
        $tp->save();
        return true;
    }


    /**
     * @param $duration
     * @param $orderProductId
     *
     * This function required order_product to be succefully created
     */
    private function createCodeBank($duration,$orderProductId,$maxCallOut,$minBalance)
    {
        $cb = new CodeBank();
        $cb->code=self::GenerateCode();
        $cb->expiredBy = self::GenerateExpiredBy($duration);
        $cb->maxCallOut = $maxCallOut;
        $cb->minBalance = $minBalance;
        $cb->order_product_id = $orderProductId;
        $cb->save();
        // Create record for code_member
        $codeMember = new CodeMember();
        $codeMember->loadDefaultValues();
        $codeMember->auth_item_name ='admin';
        $codeMember->user_id = Yii::$app->user->identity->id;
        $codeMember->link('codeBank',$cb);
        if(Yii::$app->authManager->getAssignment('admin',Yii::$app->user->identity->id) == null )
        {
            $adminRole = Yii::$app->authManager->getRole('admin');
            Yii::$app->authManager->assign($adminRole,Yii::$app->user->identity->id);
        }

        return true;

    }

    public static function GenerateExpiredBy($duration,$currentIntegerDate = null)
    {
        $date = date_create();
        $current = date_format($date,'Y-m-d H:i:s');
        return date('U', strtotime($current. ' + '.$duration.' days'));
    }

    public static function GenerateCode()
    {
        $id = rand(1,1679616);
        $code = false;
        $code = Yii::$app->db->createCommand('SELECT code FROM code WHERE id=' . $id . ' and sold=0')->queryOne();
        return $code == false? false:$code['code'];
    }


}