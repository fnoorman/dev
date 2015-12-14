<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 10/5/15
 * Time: 10:22 AM
 */

namespace common\modules\api\controllers;

use common\models\Answer;
use Yii;
use yii\rest\Controller;
use common\models\Campaign;
class CampaignController extends Controller
{
    public function actionCreate()
    {
        $response = ['action'=>'reload-page','form'=>''];
        $request = Yii::$app->request;
        $model = new Campaign();
        $model->loadDefaultValues();
        if($request->isAjax && $request->isPost)
        {
           if($model->load($request->post()))
           {
               $model->startDate = isset($model->startDate)? date('U', strtotime($model->startDate)):null;
               $model->endDate = isset($model->endDate)? date('U', strtotime($model->endDate)):null;
               $model->save();
                return $response;
           }
        }

        $code = Yii::$app->request->get('code');

        $form = Yii::$app->controller->renderPartial('@frontend/views/campaign/_form',['model'=>$model,'code'=>$code],true);
        return ['action'=>'create','form'=>$form];;
    }


    public function actionObjectiveAnswer($qType)
    {
        $answer = new Answer();
        $form = Yii::$app->controller->renderPartial('@frontend/views/answer/_answer_item',['model'=>$answer,'qType'=>$qType]);
        return ['html'=>$form];
    }


}