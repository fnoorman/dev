<?php

namespace frontend\controllers;

use common\models\Messages;
use common\models\User;
use frontend\models\CodeMemberForm;
use Yii;
use common\models\CodeMember;
use common\models\CodeMemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CodeController implements the CRUD actions for CodeMember model.
 */
class CodeController extends Controller
{
    public $layout ='unify/menu';
    public $roleOptions = [
        'admin'=>'Admin',
        'supervisor'=>'Supervisor',
        'moderator'=>'Moderator',
        'observer'=>'Observer',
        'distribution'=>'Distribution',
    ];

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
     * Lists all CodeMember models.
     * @return mixed
     */
    public function actionIndex($user_id,$code=null,$group_code=null)
    {
        $form=null;
        if(isset($code))
        {
            $cm = new CodeMemberForm();
            $cm->codeBank_code = $code;
            $form = $this->renderPartial('_form_member',['model'=>$cm,'roleOptions'=>$this->roleOptions]);
        }
        $searchModel = new CodeMemberSearch();
        $searchModel->user_id = $user_id;
        if(isset($group_code))
        {
            $searchModel->codeBank_code = Yii::$app->user->identity->availableGroupCodes;
        }
        else
        {
            $searchModel->auth_item_name ='admin';
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'form'=>$form,
        ]);
    }

    /**
     * Displays a single CodeMember model.
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
     * Creates a new CodeMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CodeMember();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CodeMember model.
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
     * Deletes an existing CodeMember model.
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
     * Finds the CodeMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CodeMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CodeMember::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateInvitation()
    {
        $request = Yii::$app->request;
        $user_id = $request->get('user_id');
        $codeMember = new CodeMemberForm();
        if($request->isPost && $codeMember->load($request->post()))
        {
            if($codeMember->validate())
            {
                $codeMember->saveToMessage();
                Yii::$app->session->setFlash('success','Your invitation has been sent to '. $codeMember->email);
                return $this->redirect(['index','user_id'=>$user_id]);
            }

        }
        $searchModel = new CodeMemberSearch();
        $searchModel->user_id = $user_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'form'=>$this->renderPartial('_form_member',['model'=>$codeMember,'roleOptions'=>$this->roleOptions]),
        ]);

        //check if the email exist
        //check if post
        //save to message set type=1 means invitation

    }

    public function actionAccept()
    {
        $codeMember = new CodeMember();
        $codeMember->user_id = Yii::$app->request->get('user_id');
        $codeMember->codeBank_code = Yii::$app->request->get('code');
        $codeMember->auth_item_name = Yii::$app->request->get('role');
        $message_id = Yii::$app->request->get('message_id');
        $codeMember->save();
        //Check auth_assignment
        if(Yii::$app->authManager->getAssignment($codeMember->auth_item_name,$codeMember->user_id) == null )
        {
            $role = Yii::$app->authManager->getRole($codeMember->auth_item_name);
            Yii::$app->authManager->assign($role,$codeMember->user_id);
        }
        $username = $codeMember->user->username;
        $message = Messages::findOne(intval($message_id));
        $message->content = Yii::$app->controller->renderPartial('_accepted_message',['username'=>$username,'role'=>$codeMember->auth_item_name,'code'=>$codeMember->codeBank_code]);
        $message->save();
        Yii::$app->session->setFlash('success','You have been added to participate for Hybrizy code: ' . $codeMember->codeBank_code);
        return $this->redirect(['/messages/index']);

    }
}
