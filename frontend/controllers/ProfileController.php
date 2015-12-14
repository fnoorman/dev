<?php
namespace frontend\controllers;

use common\models\CodeBank;
use common\models\OrderForm;
use common\models\Profile;
use common\models\ProfileForm;
use common\models\User;
use frontend\models\ChangePasswordForm;
//use frontend\models\UserForm;
use Yii;
use yii\base\InvalidParamException;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\web\Response;
use common\models\CodeBankCampaign;

/**
 * Site controller
 */
class ProfileController extends Controller
{
    public $layout = 'unify/menu';
    public $roleOptions = ['admin'=>'admin','supervisor'=>'supervisor','moderator'=>'moderator','observer'=>'observer','distribution'];
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays profile homepage.
     *
     * @return mixed
     */
    public function actionIndex($code=null)
    {

        $codes = Yii::$app->user->identity->availableCodes;
        $allCodes = array_merge($codes,Yii::$app->user->identity->availableGroupCodes);
        $campaigns = CodeBankCampaign::find()->where(['codeBank_code'=>$allCodes])->all();

        $model = CodeBank::find()->where(['code'=>$codes])->all();
        return $this->render('index',['model'=>$model,'roleOptions'=>$this->roleOptions,'allCodes'=>$allCodes,'selectedCode'=>$code,'campaigns'=>$campaigns]);
    }

    public function actionSetting($tab=null ,$alert = null)
    {
        $userForm = User::findOne(Yii::$app->user->identity->id);
        $paymentForm = Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        if(!isset($paymentForm))
        {
            $paymentForm = new ProfileForm();
        }
        $passwordForm = new ChangePasswordForm();
        $passwordForm->id = $userForm->id;
        $tab = isset($tab)? $tab: 'profile';
        $message[$tab] = $alert;
        return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>$tab,'paymentForm'=>$paymentForm,'message'=>$message]);
    }

    public function actionUpdateUser()
    {
        $userForm = User::findOne(Yii::$app->user->identity->id);
        $paymentForm = Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        if(!isset($paymentForm))
        {
            $paymentForm = new ProfileForm();
        }
        $passwordForm = new ChangePasswordForm();
        $passwordForm->id = $userForm->id;
        $request = Yii::$app->request;
        if($request->isPost && $userForm->load($request->post()) && $userForm->validate())
        {
            $userForm->save();
            return $this->redirect(['setting','tab'=>'profile']);
        }
        return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'profile','paymentForm'=>$paymentForm]);

    }

    public function actionChangePassword()
    {
        $passwordForm = new ChangePasswordForm();
        $paymentForm = Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        if(!isset($paymentForm))
        {
            $paymentForm = new ProfileForm();
        }
        $userForm = User::findOne(Yii::$app->user->identity->id);
        $passwordForm->id = $userForm->id;
        $request = Yii::$app->request;
        if($request->isPost && $passwordForm->load($request->post()) && $passwordForm->validate())
        {
            if($passwordForm->save())
                return $this->redirect(['setting','tab'=>'passwordTab','alert'=>$passwordForm->getAlert()]);
            else
                return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'passwordTab','paymentForm'=>$paymentForm]);
        }
        return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'passwordTab','paymentForm'=>$paymentForm]);

    }

    public function actionPaymentCreate()
    {
        $passwordForm = new ChangePasswordForm();
        $paymentForm = new ProfileForm();
        $userForm = User::findOne(Yii::$app->user->identity->id);
        $passwordForm->id = $userForm->id;
        $request = Yii::$app->request;
        if($request->isPost && $paymentForm->load($request->post()) && $paymentForm->validate())
        {
            $paymentForm->save();
            return $this->redirect(['setting','tab'=>'payment']);
//            return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'passwordTab','paymentForm'=>$paymentForm]);
        }
        return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'payment','profileForm'=>$paymentForm]);
    }

    public function actionPaymentUpdate()
    {
        $passwordForm = new ChangePasswordForm();
        $paymentForm = Profile::findOne(Yii::$app->user->id);
        $userForm = User::findOne(Yii::$app->user->identity->id);
        $passwordForm->id = $userForm->id;
        $request = Yii::$app->request;
        if($request->isPost && $paymentForm->load($request->post()) && $paymentForm->validate())
        {
            $paymentForm->save();
            return $this->redirect(['setting','tab'=>'payment']);
//            return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'passwordTab','paymentForm'=>$paymentForm]);
        }
        return $this->render('setting',['userForm'=>$userForm,'passwordForm'=>$passwordForm,'tab'=>'payment','profileForm'=>$paymentForm]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionCheckout($force_step=null)
    {
        $step = isset($force_step)? $force_step:'1';
        $form ='';
        $request = Yii::$app->request;
        $orderForm = new OrderForm();
        $cart =  unserialize(Yii::$app->user->identity->cart);
        $orderForm->scenario = OrderForm::SCENARIO_CHECKOUT;
        if($request->isPost)
        {
            $orderForm->load($request->post());
            if($orderForm->validate())
            {
                $step = "3";
                $orderForm->total = $cart['grandTotal'];
                $order = $orderForm->save();
                if($order !== false)
                {
                    $form = Yii::$app->controller->renderPartial('_molpay_progress',['model'=>$orderForm->getMolPayTxData()]);
                }

            }
            else
                $step = "2";
        }
        else
        {
            $userProfile = Yii::$app->user->identity->profile;
            $orderForm->attributes = $userProfile->toArray();
        }
        return $this->render('checkout',['cart'=>$cart,'order'=>$orderForm,'step'=>$step,'form'=>$form]);
    }

    public function beforeAction($action)
    {
        if ($action->id === 'molpay-response') {
            $this->enableCsrfValidation = false;
        }else {
            $this->enableCsrfValidation = true;
        }

        return parent::beforeAction($action);
    }

    public function actionMolpayResponse()
    {
        /********************************
         *Don't change below parameters
         ********************************/
        $tranID = $_POST['tranID'];
        $orderid = $_POST['orderid'];
        $status = $_POST['status'];
        $domain = $_POST['domain'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $appcode = $_POST['appcode'];
        $paydate =  $_POST['paydate'];
        $skey = $_POST['skey'];
        /***********************************************************
         * To verify the data integrity sending by MOLPay
         ************************************************************/
        $key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
        $key1 = md5( $paydate.$domain.$key0.$appcode.Yii::$app->params['verifyKey'] );
        if( $skey != $key1 )
        {
            $status= -1; // Invalid transaction.
        }

        if($status == "00")
        {
            //Get order id
            $oidArray = explode('-',$orderid);
            $oid = intval($oidArray[count($oidArray)-1]);
            // Get cart from user table to insert into order_product
            $cart = unserialize(Yii::$app->user->identity->cart);
            // Prepare for codeBank
            foreach($cart['data'] as $key=>$value)
            {
                $objectId = explode('-',$key);
                $result = Yii::$app->controller->run(
                    '/api/process-order/process',
                    [
                        'objectId'=>$objectId[1],
                        'modelClass'=>$value['modelClass'],
                        'orderId'=>$oid
                    ]
                );
            }
            // Set order_status_id = 0 at order
            Yii::$app->db->createCommand()->update('order',['order_status_id'=>1],'id = '.$oid)->execute();
            // Set cart = null at table user
            Yii::$app->user->identity->clearCart();
            // Remove session Hybrizy
            Yii::$app->session->remove('Hybrizy');
            return $this->redirect(['/profile/checkout','force_step'=>4]);
        }
        else
        {
            Yii::$app->session->setFlash('error','Your transaction did not go through. Please check your order or contact email webadmin@hybrizy.com for futher investigation ');
            return $this->redirect(['/profile/checkout','force_step'=>1]);
        }


    }
}
