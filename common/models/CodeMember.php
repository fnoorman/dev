<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%code_member}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $auth_item_name
 * @property integer $user_id
 * @property string $codeBank_code
 *
 * @property CodeBank $codeBankCode
 * @property AuthItem $authItemName
 * @property User $user
 */
class CodeMember extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            OwnerBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%code_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'user_id'], 'integer'],
            [['auth_item_name', 'user_id', 'codeBank_code'], 'required'],
            [['auth_item_name'], 'string', 'max' => 64],
            [['codeBank_code'], 'string', 'max' => 19]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'auth_item_name' => Yii::t('app', 'Role'),
            'user_id' => Yii::t('app', 'User ID'),
            'codeBank_code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodeBank()
    {
        return $this->hasOne(CodeBank::className(), ['code' => 'codeBank_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'auth_item_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return CodeMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeMemberQuery(get_called_class());
    }




}
