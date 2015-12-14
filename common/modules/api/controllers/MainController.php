<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 10/1/15
 * Time: 4:03 PM
 */
namespace common\modules\api\controllers;

use common\models\CodeBank;
use yii\rest\Controller;
use common\models\OrderProduct;
use common\models\Topup;
use Yii;



class MainController extends Controller
{

    public function actionGetTopup()
    {
        return OrderProduct::find()->topups(Yii::$app->user->id);
    }

    public function actionCodes()
    {
//        $packages = OrderProduct::find()->codes(\Yii::$app->user->id);
        $packages = OrderProduct::find()->codes(\Yii::$app->user->id);
        $codes = [""=>'Please select code'];
        foreach($packages as $package)
        {
            $codes[$package]=$package;
        }
        $topups = OrderProduct::find()->select(['id','name'])->availableProduct('Topup',Yii::$app->user->id)->asArray()->all();
        $result = \Yii::$app->controller->renderPartial('@frontend/views/site/_topup_list',['codes'=>$codes,'topups'=>$topups],true);
        return $result;

    }

    public function actionUpdateTopup()
    {
        $result = \Yii::$app->request->post();
        foreach($result as $key => $value)
        {

            Yii::$app->db->createCommand('Update toppupBank set code=:code , used=1 where order_product_id=:key')
                ->bindValue(':code',$value)
                ->bindValue(':key',$key)
                ->execute();

            $codeBank = CodeBank::find()->where(['code'=>$value])->one();
            // Get Topup id
            $orderProduct = OrderProduct::findOne($key);
            // Get topup maxCallOut
            $tp = Topup::findOne($orderProduct->objectId);
            $codeBank->updateCounters(['maxCallout'=>$tp->maxCallOut]);
        }
        return 1;
    }

}