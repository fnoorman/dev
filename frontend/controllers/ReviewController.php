<?php

namespace frontend\controllers;

use common\models\CodeBankCampaign;
use Yii;
use common\models\Review;
use common\models\ReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\controllers\HybrizyController;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends HybrizyController
{
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
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $searchModel->created_by = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Review model.
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
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Review model.
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
            ]);
        }
    }

    /**
     * Deletes an existing Review model.
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
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoadReview($codeBankCampaign)
    {
        $model = new Review();
        $model->scenario = 'campaign';
        return $this->render('step',['model'=>$model,'codeBankCampaign'=>$codeBankCampaign]);
    }

    public function actionConfirmed()
    {
        $codeBankCampaign = new CodeBankCampaign();
        $codeBankCampaign->loadDefaultValues();
        $review = new Review();
        $review->loadDefaultValues();
        $request = Yii::$app->request;
        if($request->isPost && $codeBankCampaign->load($request->post()) && $review->load($request->post()) )
        {
            $isValid = $codeBankCampaign->validate();
            $isValid = $review->validate() && $isValid;
            if($isValid)
            {
                if($review->save())
                {
                    $codeBankCampaign->objectId = $review->id;
                    $codeBankCampaign->save();
                    return $this->redirect(['/campaign/index']);
                }
            }
        }
        return $this->render('step',['model'=>$review,'codeBankCampaign'=>$codeBankCampaign]);
    }
}