<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;
use common\components\behaviors\OwnerBehavior;

/**
 * This is the model class for table "{{%topup}}".
 *
 * @property integer $id
 * @property string $name
 * @property double $unitPrice
 * @property integer $maxCallOut
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $update_by
 * @property integer $created_by
 * @property integer $position
 * @property integer $enable
 * @property string $price
 * @property integer $limitBy
 * @property integer $quota
 */
class Topup extends \yii\db\ActiveRecord
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
        return '{{%topup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','unitPrice','maxCallOut','position','price'],'required'],
            [['unitPrice', 'price'], 'number'],
            [['maxCallOut', 'updated_at', 'created_at', 'update_by', 'created_by', 'position', 'enable', 'limitBy', 'quota'], 'integer'],
            [['name'], 'string', 'max' => 80]
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
            'unitPrice' => Yii::t('app', 'Unit Price'),
            'maxCallOut' => Yii::t('app', 'Call Outs'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_by' => Yii::t('app', 'Update By'),
            'created_by' => Yii::t('app', 'Created By'),
            'position' => Yii::t('app', 'Position'),
            'enable' => Yii::t('app', 'Enable'),
            'price' => Yii::t('app', 'Price'),
            'limitBy' => Yii::t('app', 'Limit By'),
            'quota' => Yii::t('app', 'Quota'),
        ];
    }

    /**
     * @inheritdoc
     * @return TopupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TopupQuery(get_called_class());
    }

    public function cartDetail()
    {
        return [

            Html::tag('span',$this->unitPrice.' Per Unit',['class'=>'label label-warning', 'style'=>'font-size:14px']),
            Html::tag('span',$this->maxCallOut.' Callouts',['class'=>'label label-success', 'style'=>'font-size:14px']),
            Html::tag('span','RM '.$this->price,['class'=>'label label-primary', 'style'=>'font-size:14px']),
        ];
    }
}
