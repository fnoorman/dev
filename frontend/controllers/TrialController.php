<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/19/15
 * Time: 11:12 AM
 *
 *
 */

/* @var $profile common\models\Profile */

namespace frontend\controllers;
use common\models\OrderForm;
use common\models\OrderProduct;
use common\models\Package;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Profile;

class TrialController extends Controller
{
    public $layout = 'unify/menu';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionTryNow($objectId,$modelClass)
    {
        if(self::TrialExist())
        {
            Yii::$app->session->setFlash('error','Sorry, You already have a trial hybrizy code');
            return $this->redirect(['/#packages']);
        }
        $order = new OrderForm(['scenario'=>OrderForm::SCENARIO_TRIAL]);
        $order->user_id = Yii::$app->user->id;

        $request = Yii::$app->request;
        if($request->isPost){
            if($order->load($request->post()) && $order->validate())
            {
                $result = $order->save();
                $result = Yii::$app->controller->run('/api/process-order/process',['objectId'=>$objectId,'modelClass'=>$modelClass,'orderId'=>$result->id]);
                if($result)
                {
                    return $this->redirect(['/profile/index']);
                }

            }

            $package = Package::findOne($objectId);
            return $this->render('index',[
                'model'=>$order,
                'package'=>$package
            ]);

        }
        $package = Package::findOne($objectId);
        $profile = Yii::$app->user->identity->profile;
        $order->firstname = $profile->firstname;
        $order->lastname = $profile->lastname;
        $order->email = Yii::$app->user->identity->email;
        return $this->render('index',[
            'model'=>$order,
            'package'=>$package
        ]);
    }

    public static function TrialExist()
    {
        return OrderProduct::find()->where(['modelClass'=>'Package','mask'=>1,'created_by'=>Yii::$app->user->id])->exists();
    }



}