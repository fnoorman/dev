<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 10/20/15
 * Time: 12:58 PM
 */

namespace console\controllers;

use common\rbac\HybrizyRule;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use common\rbac\UserGroupRule;



class RbacController extends Controller
{
    public function actionAddRule($ruleName)
    {
        $auth = Yii::$app->authManager;
        $modelClass = Yii::$app->params['rbacRule'].$ruleName;
        $rule = new $modelClass();
        $auth->add($rule);
        echo "Done add rule: ". $rule->name;
        echo "\n";
    }

    public function actionAssignGroup($name)
    {
        $auth = Yii::$app->authManager;
        $rule = $auth->getRule('userGroup');
        $role = $auth->createRole($name);
        $role->ruleName = $rule->name;
        $auth->add($role);
        echo "Done add role: ". $name;
        echo "\n";
    }

    public function actionAddChild($parent,$child)
    {
        $auth = Yii::$app->authManager;
        $parent = $auth->getRole($parent);
        $child = $auth->getRole($child);
        $auth->addChild($parent,$child);
        echo "Done add child: ". $child->name. ' to parent: '. $parent->name;
        echo "\n";

    }
}



