<?php

namespace frontend\controllers;

use Yii;
use common\models\CodeBankCampaign;
use common\models\CodeBankCampaignSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampaignController implements the CRUD actions for CodeBankCampaign model.
 */
class CampaignController extends Controller
{
    public $layout ='unify/menu';


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CodeBankCampaign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CodeBankCampaignSearch();
        $codes = array_merge(Yii::$app->user->identity->availableCodes,Yii::$app->user->identity->availableGroupCodes);
        $searchModel->codeBank_code = $codes;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort =  ['defaultOrder' => ['modelClass'=>SORT_ASC]];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CodeBankCampaign model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CodeBankCampaign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($step=null)
    {
        $model = new CodeBankCampaign();
        $model->loadDefaultValues();
        $model->scenario = 'step1';
        $codes = Yii::$app->user->identity->availableCodes;
        $codes = ArrayHelper::merge($codes,Yii::$app->user->identity->availableGroupCodes);
        $request = Yii::$app->request;
        foreach($codes as $key=>$value)
        {
            if(Yii::$app->user->can('createCampaign',['code'=>$value]))
                $allCodes[$value]=$value;
        }
        if ($model->load($request->post()) && isset($step) && $model->validate()) {
            switch($model->modelClass) {
                case 'Video':
                    return $this->run('/video/load-video',['codeBankCampaign'=>$model]);
                    break;
                case 'Review':
                    return $this->run('/review/load-review',['codeBankCampaign'=>$model]);
                    break;
                case 'Contest':
                    return $this->run('/question/load-review',['codeBankCampaign'=>$model]);
                    break;
                default:

            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'codes'=>$allCodes
            ]);
        }
    }

    /**
     * Updates an existing CodeBankCampaign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'codes'=>$this->allowedCodes('updateCampaign')
            ]);
        }
    }

    /**
     * Deletes an existing CodeBankCampaign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CodeBankCampaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CodeBankCampaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CodeBankCampaign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStep($number,$campaignType)
    {

    }

    public function allowedCodes($permission)
    {
        $allowedCodes =[];
        $availableCodes = Yii::$app->user->identity->availableCodes;
        $availableGroupCodes = Yii::$app->user->identity->availableGroupCodes;
        $codes = array_merge($availableCodes,$availableGroupCodes);
        foreach($codes as $key=>$value)
        {
            if(Yii::$app->user->can($permission,['code'=>$value]))
                $allowedCodes[$value]=$value;
        }
        return $allowedCodes;
    }
}
