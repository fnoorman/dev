<?php

namespace backend\controllers;

use common\models\AuthorizationForm;
use Yii;
use common\models\AuthItem;
use common\models\AuthItemForm;
use common\models\AuthItemSearch;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\assets\ProfileUnifyAsset;




/**
 * AuthorizationController implements the CRUD actions for AuthItem model.
 */
class AuthorizationController extends Controller
{
    public $layout = 'unify/main';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superadmin'],
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

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = Yii::$app->request->get('type');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'AuthItemForm' => new AuthItemForm(),
        ]);
    }


    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id,$type=1,$actionType=1)
    {
        $authModel = new AuthorizationForm();
        $authModel->scenario = AuthorizationForm::SCENARIO_VIEW;
        $authModel->parent = $id;
        $authModel->parentType = $type;
        $authModel->actionType = $actionType;
        $authModel->validate();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'authModel'=>$authModel,
            'descendants'=>$authModel->getDescendants(),
            'ascendants'=>$authModel->getAncendants(),
            'permissions'=>$authModel->getPermissions(),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItemForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {

            $searchModel = new AuthItemSearch();
            $searchModel->type = Yii::$app->request->post('AuthItemForm[type]');
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'AuthItemForm' => new AuthItemForm(),
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id,$type)
    {
//        $authItem = $this->findModel($id);
        $authItem = intval($type) === Item::TYPE_PERMISSION ? Yii::$app->authManager->getPermission($id): Yii::$app->authManager->getRole($id);
        $model = new AuthItemForm();
        $model->scenario = AuthItemForm::SCENARIO_UPDATE;
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            // Setting data model for the form
            $model->name = $authItem->name ;
            $model->description = $authItem->description;
            $model->type = $authItem->type;
            $model->data = $authItem->data;
            // Setting data model for the grid
            $searchModel = new AuthItemSearch();
            $searchModel->type = $model->type;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'AuthItemForm' => $model,
            ]);
        }
    }

    public function actionAssign()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $authModel = new AuthorizationForm();
            $authModel->scenario = AuthorizationForm::SCENARIO_ASSIGN;
            if($authModel->load($request->post()) && $authModel->validate())
            {
                if($authModel->assign())
                    return $this->redirect(['view','id'=>$authModel->parent,'type'=>$authModel->parentType]);
            }

            return $this->render('view', [
                'model' => $this->findModel($authModel->parent),
                'authModel'=>$authModel,
                'descendants'=>$authModel->getDescendants(),
                'ascendants'=>$authModel->getAncendants(),
                'permissions'=>$authModel->getPermissions(),
            ]);
        }

    }

    public function actionRemoveChild()
    {
        $request = Yii::$app->request;
        $auth = Yii::$app->authManager;
        $parent = $request->get('parent');
        $parentType = $request->get('parentType');
        $child = $request->get('child');
        $childType = $request->get('childType');
        $parent = intval($parentType) === \yii\rbac\Item::TYPE_ROLE ? $auth->getRole($parent):$auth->getPermission($parent);
        $child = intval($childType) === \yii\rbac\Item::TYPE_ROLE ? $auth->getRole($child):$auth->getPermission($child);
        $auth->removeChild($parent,$child);

        $authModel = new AuthorizationForm();
        $authModel->scenario = AuthorizationForm::SCENARIO_VIEW;
        $authModel->parent = $request->get('parent');
        $authModel->parentType = $request->get('parentType');
        $authModel->actionType = $request->get('childType');
        $authModel->validate();
        return $this->render('view',[
            'model' => $this->findModel($request->get('parent')),
            'authModel'=>$authModel,
            'descendants'=>$authModel->getDescendants(),
            'ascendants'=>$authModel->getAncendants(),
            'permissions'=>$authModel->getPermissions(),
        ]);


    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id,$type)
    {
        $auth = Yii::$app->authManager;
        $item = intval($type) === Item::TYPE_ROLE ? $auth->getRole($id):$auth->getPermission($id);
        $auth->remove($item);
        return $this->redirect(['index','type'=>$type]);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
