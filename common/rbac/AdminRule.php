<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/26/15
 * Time: 10:59 PM
 */

namespace common\rbac;

use yii\db\Query;
use yii\rbac\Rule;

class AdminRule extends Rule
{
    public $name = 'isAdmin';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $result = (new Query())->select('codeBank_code')->from('code_member')->where(['auth_item_name'=>'admin','user_id'=>$user,'codeBank_code'=>$params['code']])->exists();
        return $result;
    }
}

