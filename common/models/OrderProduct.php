<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\CodeBank;
use common\models\ToppupBank;
/**
 * This is the model class for table "{{%order_product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $modelClass
 * @property integer $objectId
 * @property integer $order_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $mask
 */
class OrderProduct extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
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
        return '{{%order_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objectId', 'order_id'], 'required'],
            [['objectId', 'order_id', 'created_at', 'updated_at', 'created_by', 'updated_by','mask'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['modelClass'], 'string', 'max' => 81]
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
            'modelClass' => Yii::t('app', 'Model Class'),
            'objectId' => Yii::t('app', 'Object ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'mask' => Yii::t('app', 'Mask'),
        ];
    }

    /**
     * @inheritdoc
     * @return OrderProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderProductQuery(get_called_class());
    }

    public function getCodes()
    {
        return $this->hasOne(CodeBank::className(),['order_product_id'=>'id']);
//        return $this->hasOne(CodeBank::className(),['order_product_id'=>'id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(),['id'=>'order_id']);
    }

//    public function getTopupBank($used = false)
//    {
//        return $this->hasOne(ToppupBank::className(),['order_product_id'=>'id'])->used($used);
//    }


}
