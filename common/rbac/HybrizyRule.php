<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/26/15
 * Time: 10:59 PM
 */

namespace common\rbac;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Rule;

class HybrizyRule extends Rule
{
    public $name = 'isMember';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return  (new Query())->select('id')->from('code_member')->where(['user_id'=>$user,'auth_item_name'=>$item->name])->exists();
    }
}

