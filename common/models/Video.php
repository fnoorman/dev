<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $size
 * @property integer $duration
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $videoId
 * @property string $mobileLink
 * @property string $sdLink
 * @property string $hlsLink
 * @property string $embed
 * @property string $poster
 * @property integer $confirmed
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description','embed','poster'], 'string'],
            [['size', 'duration', 'created_at', 'updated_at', 'created_by', 'updated_by', 'confirmed'], 'integer'],
            [['videoId'], 'required'],
            [['title'], 'string', 'max' => 81],
            [['videoId'], 'string', 'max' => 45],
            [['mobileLink', 'sdLink', 'hlsLink'], 'string', 'max' => 255]
        ];
    }

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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'size' => Yii::t('app', 'Size'),
            'duration' => Yii::t('app', 'Duration'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'videoId' => Yii::t('app', 'Video ID'),
            'mobileLink' => Yii::t('app', 'Mobile Link'),
            'sdLink' => Yii::t('app', 'Sd Link'),
            'hlsLink' => Yii::t('app', 'Hls Link'),
            'confirmed' => Yii::t('app', 'Confirmed'),
            'embed' => Yii::t('app', 'HTML Embed'),
            'poster' => Yii::t('app', 'Poster Video'),
        ];
    }

    /**
     * @inheritdoc
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }
}
