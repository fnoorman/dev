<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/26/15
 * Time: 10:59 PM
 */

namespace common\rbac;

use common\models\UserGroup;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';


    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest)
        {
            // get the group id
            $result = (new Query())->select('g.id,g.name,ug.auth_item_name')->from('user_group ug')
                    ->innerJoin('group g','g.id=ug.group_id')
                    ->where(['ug.user_id'=>Yii::$app->user->id])
                    ->one();
            if(count($result)>0){
                $group_id = $result['id'];
                $group_name = $result['name'];
                if($item->name == $group_name)
                {
                    return true;
                }
                elseif($this->roleIsInGroup($group_name,$item->name))
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function roleIsInGroup($role_name,$item_name)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRecursiveAssignedRole($role_name);
        if(count($roles) > 0)
            return array_key_exists($item_name,$roles);
        return false;
    }
}

