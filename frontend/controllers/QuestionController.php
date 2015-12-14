<?php

namespace frontend\controllers;

use common\models\Answer;
use common\models\CodeBankCampaign;
use Yii;
use common\models\Question;
use common\models\QuestionSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\controllers\HybrizyController;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends HybrizyController
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
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
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoadReview($codeBankCampaign = null,$codes=null)
    {
        $model = new Question();
        $answers = [];
        return $this->render('step',['model'=>$model,'codeBankCampaign'=>$codeBankCampaign,'answers'=>$answers]);
    }

    public function actionStep()
    {
        $model = new Question();
        $answers = [];
        $count = count(Yii::$app->request->post('Answer',[]));
        $codeBankCampaign = new CodeBankCampaign();
        $codeBankCampaign->load(Yii::$app->request->post());
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($count > 0)
            {
                if($model->qType === '1')
                {
                    $temp = Yii::$app->request->post('Answer',[]);
                    $count = count($temp['answer']);
                    for($i= 0; $i < $count;$i++)
                    {
                        $answer = new Answer();
                        $answer->scenario = 'objective';
                        $answer->answer = $temp['answer'][$i];
                        $answer->correctObjective = $temp['correctObjective'][$i];
                        $answer->validate();
                        $answers[]= $answer;
                    }
                }

            }
        }
        return $this->render('step',['model'=>$model,'codeBankCampaign'=>$codeBankCampaign,'answers'=>$answers]);
    }
}
