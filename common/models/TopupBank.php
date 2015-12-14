<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\behaviors\OwnerBehavior;

/**
 * This is the model class for table "{{%toppupBank}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $order_product_id
 * @property integer $used
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property OrderProduct $orderProduct
 */
class TopupBank extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
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
        return '{{%topupBank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_product_id'], 'required'],
            [['order_product_id', 'used', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 19]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'order_product_id' => Yii::t('app', 'Order Product ID'),
            'used' => Yii::t('app', 'Used'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProduct()
    {
        return $this->hasOne(OrderProduct::className(), ['id' => 'order_product_id']);
    }

    /**
     * @inheritdoc
     * @return ToppupBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TopupBankQuery(get_called_class());
    }
}
