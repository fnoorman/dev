<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
/**
 * This is the model class for table "{{%codeBank}}".
 *
 * @property string $code
 * @property integer $expiredBy
 * @property integer $enable
 * @property integer $maxCallOut
 * @property integer $minBalance
 * @property integer $order_product_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property OrderProduct $orderProduct
 */
class CodeBank extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%codeBank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'expiredBy', 'order_product_id'], 'required'],
            [['expiredBy', 'enable', 'maxCallOut', 'minBalance', 'order_product_id','created_at','updated_at'], 'integer'],
            [['code'], 'string', 'max' => 19]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'expiredBy' => Yii::t('app', 'Expired By'),
            'enable' => Yii::t('app', 'Enable'),
            'maxCallOut' => Yii::t('app', 'Max Call Out'),
            'minBalance' => Yii::t('app', 'Min Balance'),
            'order_product_id' => Yii::t('app', 'Order Product ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
     * @return CodeBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeBankQuery(get_called_class());
    }

    public function getCodeMembers()
    {
        return $this->hasMany(CodeMember::className(),['codeBank_code'=>'code']);
    }

    public function getMembersLabel()
    {
        $model =$this->codeMembers;
        $url = Html::a(count($model),['/group/index','code'=>$this->code]);
        return Html::tag('span',$url,['class'=>'label label-info']);
    }
}
