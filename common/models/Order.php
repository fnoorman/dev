<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $invoice_no
 * @property string $invoice_prefix
 * @property integer $store_id
 * @property string $store_name
 * @property string $store_url
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $payment_firstname
 * @property string $payment_lastname
 * @property string $payment_company
 * @property string $payment_company_id
 * @property string $payment_tax_id
 * @property string $payment_address_1
 * @property string $payment_address_2
 * @property string $payment_city
 * @property string $payment_postcode
 * @property string $payment_country
 * @property integer $payment_country_id
 * @property string $payment_zone
 * @property integer $payment_zone_id
 * @property string $payment_address_format
 * @property string $payment_method
 * @property string $payment_code
 * @property string $shipping_firstname
 * @property string $shipping_lastname
 * @property string $shipping_company
 * @property string $shipping_address_1
 * @property string $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_postcode
 * @property string $shipping_country
 * @property integer $shipping_country_id
 * @property string $shipping_zone
 * @property integer $shipping_zone_id
 * @property string $shipping_address_format
 * @property string $shipping_method
 * @property string $shipping_code
 * @property string $comment
 * @property string $total
 * @property integer $order_status_id
 * @property integer $affiliate_id
 * @property string $commission
 * @property integer $language_id
 * @property integer $currency_id
 * @property string $currency_code
 * @property string $currency_value
 * @property string $ip
 * @property string $forwarded_ip
 * @property string $user_agent
 * @property string $accept_language
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends \yii\db\ActiveRecord
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
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_no', 'store_id', 'user_id', 'payment_country_id', 'payment_zone_id', 'shipping_country_id', 'shipping_zone_id', 'order_status_id', 'affiliate_id', 'language_id', 'currency_id', 'created_at', 'updated_at','updated_by','created_by'], 'integer'],
            [['invoice_prefix', 'store_name', 'store_url', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_company_id', 'payment_tax_id', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_country_id', 'payment_zone', 'payment_zone_id', 'payment_address_format', 'payment_method', 'payment_code', 'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_country_id', 'shipping_zone', 'shipping_zone_id', 'shipping_address_format', 'shipping_method', 'shipping_code', 'comment', 'affiliate_id', 'commission', 'language_id', 'currency_id', 'currency_code', 'ip', 'forwarded_ip', 'user_agent', 'accept_language', 'created_at', 'updated_at'], 'safe'],
            [['payment_address_format', 'shipping_address_format', 'comment'], 'string'],
            [['total', 'commission', 'currency_value'], 'number'],
            [['invoice_prefix'], 'string', 'max' => 26],
            [['store_name'], 'string', 'max' => 64],
            [['store_url', 'user_agent', 'accept_language'], 'string', 'max' => 255],
            [['firstname', 'lastname', 'telephone', 'fax', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_company_id', 'payment_tax_id', 'shipping_firstname', 'shipping_lastname', 'shipping_company'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['payment_address_1', 'payment_address_2', 'payment_city', 'payment_country', 'payment_zone', 'payment_method', 'payment_code', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_country', 'shipping_zone', 'shipping_method', 'shipping_code'], 'string', 'max' => 128],
            [['payment_postcode', 'shipping_postcode'], 'string', 'max' => 10],
            [['currency_code'], 'string', 'max' => 3],
            [['ip', 'forwarded_ip'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'invoice_no' => Yii::t('app', 'Invoice No'),
            'invoice_prefix' => Yii::t('app', 'Invoice Prefix'),
            'store_id' => Yii::t('app', 'Store ID'),
            'store_name' => Yii::t('app', 'Store Name'),
            'store_url' => Yii::t('app', 'Store Url'),
            'user_id' => Yii::t('app', 'User ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
            'fax' => Yii::t('app', 'Fax'),
            'payment_firstname' => Yii::t('app', 'Payment Firstname'),
            'payment_lastname' => Yii::t('app', 'Payment Lastname'),
            'payment_company' => Yii::t('app', 'Payment Company'),
            'payment_company_id' => Yii::t('app', 'Payment Company ID'),
            'payment_tax_id' => Yii::t('app', 'Payment Tax ID'),
            'payment_address_1' => Yii::t('app', 'Payment Address 1'),
            'payment_address_2' => Yii::t('app', 'Payment Address 2'),
            'payment_city' => Yii::t('app', 'Payment City'),
            'payment_postcode' => Yii::t('app', 'Payment Postcode'),
            'payment_country' => Yii::t('app', 'Payment Country'),
            'payment_country_id' => Yii::t('app', 'Payment Country ID'),
            'payment_zone' => Yii::t('app', 'Payment Zone'),
            'payment_zone_id' => Yii::t('app', 'Payment Zone ID'),
            'payment_address_format' => Yii::t('app', 'Payment Address Format'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'payment_code' => Yii::t('app', 'Payment Code'),
            'shipping_firstname' => Yii::t('app', 'Shipping Firstname'),
            'shipping_lastname' => Yii::t('app', 'Shipping Lastname'),
            'shipping_company' => Yii::t('app', 'Shipping Company'),
            'shipping_address_1' => Yii::t('app', 'Shipping Address 1'),
            'shipping_address_2' => Yii::t('app', 'Shipping Address 2'),
            'shipping_city' => Yii::t('app', 'Shipping City'),
            'shipping_postcode' => Yii::t('app', 'Shipping Postcode'),
            'shipping_country' => Yii::t('app', 'Shipping Country'),
            'shipping_country_id' => Yii::t('app', 'Shipping Country ID'),
            'shipping_zone' => Yii::t('app', 'Shipping Zone'),
            'shipping_zone_id' => Yii::t('app', 'Shipping Zone ID'),
            'shipping_address_format' => Yii::t('app', 'Shipping Address Format'),
            'shipping_method' => Yii::t('app', 'Shipping Method'),
            'shipping_code' => Yii::t('app', 'Shipping Code'),
            'comment' => Yii::t('app', 'Comment'),
            'total' => Yii::t('app', 'Total'),
            'order_status_id' => Yii::t('app', 'Order Status ID'),
            'affiliate_id' => Yii::t('app', 'Affiliate ID'),
            'commission' => Yii::t('app', 'Commission'),
            'language_id' => Yii::t('app', 'Language ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'currency_code' => Yii::t('app', 'Currency Code'),
            'currency_value' => Yii::t('app', 'Currency Value'),
            'ip' => Yii::t('app', 'Ip'),
            'forwarded_ip' => Yii::t('app', 'Forwarded Ip'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'accept_language' => Yii::t('app', 'Accept Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated by'),
            'created_by' => Yii::t('app', 'Created by'),
        ];
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(),['order_id'=>'id']);
    }


}
