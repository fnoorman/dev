<?php

namespace frontend\controllers;

use common\models\CodeBankCampaign;
use Vimeo\Vimeo;
use Yii;
use common\models\Video;
use common\models\VideoSearch;
use frontend\controllers\HybrizyController;
use yii\bootstrap\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends HybrizyController
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
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
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $view = $this->getView();
        $view->title = "Update Video Information";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
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
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoadVideo($codeBankCampaign = null,$codes=null)
    {
        $request = Yii::$app->request;
        $model = new Video();
        $model->scenario = 'step';
        return $this->render('step',['model'=>$model,'codeBankCampaign'=>$codeBankCampaign,'codes'=>$codes]);

    }

    public function actionConfirmed()
    {
        $codeBankCampaign = new CodeBankCampaign();
        $codeBankCampaign->loadDefaultValues();
        $video = new Video();
        $video->loadDefaultValues();
        $request = Yii::$app->request;
        if($request->isPost)
        {
            $lib = new Vimeo(Yii::$app->params['vimeoClientId'],Yii::$app->params['vimeoSecret'],Yii::$app->params['vimeoAccessToken']);
            if($codeBankCampaign->load($request->post()) && $video->load($request->post()))
            {
                $response = $lib->request('/me/videos/'.$video->videoId, [], 'GET');
                $video->duration = $response['body']['duration'];
                $video->embed = $response['body']['embed']['html'];
                $video->poster = $response['body']['pictures']['sizes'][3]['link'];
                $files = $response['body']['files'];
                foreach($files as $key=>$value)
                {
                    switch($value['quality']){
                        case 'mobile':
                            $video->mobileLink = $value['link'];
                            break;
                        case 'sd':
                            $video->sdLink = $value['link'];
                            break;
                        case 'hls':
                            $video->hlsLink = $value['link'];
                            break;
                    }
                }
                if(isset($codeBankCampaign->codeBank_code))
                {
                    $video->confirmed = 1;
                }
                $video->save();
                $codeBankCampaign->objectId = $video->id;
                $codeBankCampaign->save();
//                $view = $this->getView();
//                $view->title = 'Step 3: Editing Video Information for Hyrizy Code ' . Html::tag('label',$codeBankCampaign->codeBank_code,['class'=>'label label-primary']);
//                return $this->render('update',['model'=>$video]);
                return $this->redirect(['/campaign/view','id'=>$codeBankCampaign->id]);

            }
        }
    }
}
