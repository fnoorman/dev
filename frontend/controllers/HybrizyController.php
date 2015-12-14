<?php

namespace frontend\controllers;

use Yii;
use common\models\Video;
use common\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\assets\ProfileUnifyAsset;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class HybrizyController extends Controller
{

    public $layout = 'unify/menu';

    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // wich are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl

        if (!parent::beforeAction($action)) {
            return false;
        }

        $view = $this->getView();
        $view->params['active'][] = $this->id;
        $view->params['active'][]=$action->id;
        ProfileUnifyAsset::register($view);

        return true; // or false to not run the action
    }

}
