<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;


/**
 * Login form
 */
class AuthorizationForm extends Model
{
    public $name;
    public $type;
    public $parent;
    public $parentType;
    public $actionType;


    const SCENARIO_VIEW = 'view';
    const SCENARIO_ASSIGN = 'assign';

    public function scenarios()
    {
        return [
            self::SCENARIO_VIEW => ['parent', 'parentType','actionType'],
            self::SCENARIO_ASSIGN => ['parent', 'name', 'parentType','type'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Scenario
            [['parent', 'parentType','actionType'], 'required',
                'when'=>function($model){
                    if($model->scenario == self::SCENARIO_VIEW)
                    {
                        $model->name = $model->parent;
                        $model->type =$model->parentType;
                    }
                }
            ],
            [['parent', 'parentType','name','type'], 'required','on'=>self::SCENARIO_ASSIGN],
            // rememberMe must be a boolean value
            [['name','parent'], 'string'],
            // password is validated by validatePassword()
            [['type','parentType','actionType'], 'integer'],

        ];
    }


    public function getAvailableOptions()
    {
        $auth = Yii::$app->authManager;
        if($this->actionType == \yii\rbac\Item::TYPE_ROLE)
        {
            return $auth->getRoleOptions($this->parent);
        }
        elseif($this->actionType == \yii\rbac\Item::TYPE_PERMISSION)
        {
            return $auth->getPermissionOptions($this->parent);
        }
        else
            return [];
    }

    public function getDescendants()
    {
        $auth = Yii::$app->authManager;
        if($this->parentType == \yii\rbac\Item::TYPE_ROLE)
        {
            return $auth->getRecursiveAssignedRole($this->parent);
        }
        elseif($this->parentType == \yii\rbac\Item::TYPE_PERMISSION)
        {
            return $auth->getRecursiveAssignedPermission($this->parent);
        }
        else
            return [];
    }

    public function getPermissions()
    {
        $auth = Yii::$app->authManager;
        return $auth->getRecursiveAssignedPermission($this->parent);
    }

    public function getAncendants()
    {
        $auth = Yii::$app->authManager;
        return $auth->getAscendants($this->parent,$this->parentType);
    }

    public function assign()
    {
        $auth = Yii::$app->authManager;
        $child = $this->type == \yii\rbac\Item::TYPE_ROLE ? $auth->getRole($this->name): $auth->getPermission($this->name);
        $parent = $this->parentType == \yii\rbac\Item::TYPE_ROLE ? $auth->getRole($this->parent): $auth->getPermission($this->parent);
        try {
            $auth->addChild($parent,$child);
            return true;
        } catch (ErrorException $e) {
            return $e;
        }
    }


}
