<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class AuthItemForm extends \yii\base\Model
{

    public $name;
    public $type;
    public $description;
    public $data;
    public $rule_name;
    public $oldName;

    const SCENARIO_UPDATE = 'update';

//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios[self::SCENARIO_UPDATE] = ['name', 'type','oldName'];
//        return $scenarios;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'type','oldName'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['type'], 'integer'],
            [['description', 'data'], 'string'],
            [['name','oldName', 'rule_name'], 'string', 'max' => 64],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function save()
    {
        $auth = Yii::$app->authManager;
        $authItem = intval($this->type) === Item::TYPE_ROLE ? $auth->createRole($this->name): $auth->createPermission($this->name);
        $authItem->description = $this->description;
        $authItem->data = $this->data;
        if(intval($this->type) === Item::TYPE_PERMISSION && $this->rule_name !== ""){
            $authItem->ruleName = $this->rule_name;
        }

        return $auth->add($authItem);
    }

    public function update()
    {
        $auth = Yii::$app->authManager;
        if($this->oldName !== $this->name) // change name
        {
            $authItem = intval($this->type) === Item::TYPE_ROLE ? $auth->getRole($this->oldName): $auth->getPermission($this->oldName);
        }
        else
        {
            $authItem = intval($this->type) === Item::TYPE_ROLE ? $auth->getRole($this->name): $auth->getPermission($this->name);
        }
        $authItem->name = $this->name;
        $authItem->description = $this->description;
        $authItem->data = $this->data;
        if(intval($this->type) === Item::TYPE_PERMISSION && $this->rule_name !== ""){
            $authItem->ruleName = $this->rule_name;
        }
        $auth->update($this->oldName,$authItem);
        return true;

    }

    public function getIsNewRecord()
    {
        return $this->name === null;
    }

    public function getAllRules()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRules(),'name','name');
    }



}
