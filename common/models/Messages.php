<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $from
 * @property string $content
 * @property integer $messageType
 * @property integer $read
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $user_id
 *
 * @property User $user
 */
class Messages extends \yii\db\ActiveRecord
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
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'from', 'messageType', 'user_id'], 'required'],
            [[ 'from', 'messageType', 'read', 'created_at', 'updated_at', 'created_by', 'updated_by', 'user_id'], 'integer'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'content' => Yii::t('app', 'Content'),
            'messageType' => Yii::t('app', 'Message Type'),
            'read' => Yii::t('app', 'Read'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'from']);
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
