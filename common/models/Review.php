<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $contents
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Review extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            OwnerBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'contents'], 'required'],
            [['contents'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 121]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'contents' => Yii::t('app', 'Contents'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created on'),
            'updated_at' => Yii::t('app', 'Last updated on'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Last updated by'),
            'userName' => Yii::t('app', 'Author'),
        ];
    }

    /**
     * @inheritdoc
     * @return ReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReviewQuery(get_called_class());
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }

    public function getUserName()
    {
        return $this->user->username;
    }

    public function getLastUpdatedBy()
    {
        $u = User::findOne($this->updated_by);
        return $u->username;
    }
}
