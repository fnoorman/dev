<?php
namespace common\modules\api\controllers;

use yii\rest\ActiveController;
use backend\models\Qrcode;

class QrcodeController extends ActiveController
{
	public $modelClass ='backend\models\Qrcode';

	public function actions()
	{
	    $actions = parent::actions();

	    // disable the "delete" and "create" actions
	    //unset($actions['view']);

	    // customize the data provider preparation with the "prepareDataProvider()" method
	    //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
	    

	    return $actions;
	}



	public function actionView($code){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$response = [];
		$record = Qrcode::find()->where(['code'=> $code])->one();

		$response['QRCode']= Qrcode::find()->where(['code'=> $code])->asArray()->all();
		$response['ImageSequence']= $record->gallery;
		// $items = ['some', 'array', 'of', 'data' => ['associative', 'array']];
    	return json_encode($response);

	}

}