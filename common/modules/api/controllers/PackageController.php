<?php  
namespace common\modules\api\controllers;

use yii\rest\Controller;
use common\models\Package;

class PackageController extends Controller
{
//	public $modelClass ='common\models\package';
//
//    public function actions()
//    {
//        $actions = parent::actions();
//
//        // disable the "delete" and "create" actions
//        unset($actions['delete'], $actions['create']);
//
//        // customize the data provider preparation with the "prepareDataProvider()" method
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//
//        return $actions;
//    }
//
//    public function prepareDataProvider()
//    {
//        // prepare and return a data provider for the "index" action
//        $result = Package::find()->where(['enable'=>1])->limit(4)->orderBy('position')->all();
//        return $result;
//    }
    public function actionFindBy($offset,$limit)
    {
        $result = Package::find()->where(['enable'=>1])->limit($limit)->offset($offset)->orderBy('position')->all();
        return $result;
    }


}
?>