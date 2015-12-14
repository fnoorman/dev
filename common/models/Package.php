<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%package}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $maxCallOut
 * @property integer $maxAllowedCode
 * @property integer $enable
 * @property string $code
 * @property string $videoMaxSize
 * @property string $pictureMaxSize
 * @property integer $minBalance
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $duration
 * @property integer $expiredBy
 * @property string $price
 * @property integer $position
 * @property integer $limitBy
 * @property integer $quota
 */
class Package extends \yii\db\ActiveRecord
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
        return '{{%package}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maxCallOut', 'maxAllowedCode'], 'required'],
            [['mask','maxCallOut', 'maxAllowedCode', 'enable', 'minBalance', 'updated_by', 'updated_at', 'created_by', 'created_at', 'duration', 'expiredBy', 'position', 'limitBy', 'quota'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 80],
            [['code'], 'string', 'max' => 19],
            [['videoMaxSize', 'pictureMaxSize','contentSize'], 'string', 'max' => 7],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'maxCallOut' => Yii::t('app', 'Call-Outs'),
            'maxAllowedCode' => Yii::t('app', 'Hybrizy Code'),
            'enable' => Yii::t('app', 'Status of the package'),
            'code' => Yii::t('app', 'package code'),
            'videoMaxSize' => Yii::t('app', 'Video Storage (MB)'),
            'pictureMaxSize' => Yii::t('app', 'Picture Max Size (MB)'),
            'minBalance' => Yii::t('app', 'Callout min. balance'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'duration' => Yii::t('app', 'Duration'),
            'expiredBy' => Yii::t('app', 'Expired By'),
            'price' => Yii::t('app', 'Price'),
            'position' => Yii::t('app', 'Position'),
            'limitBy' => Yii::t('app', 'Limit By'),
            'quota' => Yii::t('app', 'Quota'),
            'mask' => Yii::t('app', 'Mask'),
            'contentSize' => Yii::t('app', ' Content Space (MB)'),
        ];
    }

    /**
     * @inheritdoc
     * @return PackageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PackageQuery(get_called_class());
    }

    /**
     * @return array selected attributes to be shown in cart inclusive css and html tag styling
     */
    public function cartDetail()
    {
        return [
            Html::tag('span',$this->maxAllowedCode.' codes',['class'=>'label label-warning', 'style'=>'font-size:14px']),
            Html::tag('span',$this->maxCallOut.' Callouts',['class'=>'label label-success', 'style'=>'font-size:14px']),
            Html::tag('span','RM '.$this->price,['class'=>'label label-primary', 'style'=>'font-size:14px']),
        ];
    }
}
