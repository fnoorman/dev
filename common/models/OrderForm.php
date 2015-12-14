<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%order}}".
 *

 */
class OrderForm extends Model
{
    public $id;
    public $invoice_no;
    public $invoice_prefix;
    public $store_id;
    public $store_name;
    public $store_url;
    public $user_id;
    public $firstname;
    public $lastname;
    public $email;
    public $telephone;
    public $fax;
    public $payment_firstname;
    public $payment_lastname;
    public $payment_company;
    public $payment_telephone;
    public $payment_company_id;
    public $payment_tax_id;
    public $payment_address_1;
    public $payment_address_2;
    public $payment_city;
    public $payment_postcode;
    public $payment_country;
    public $payment_country_id;
    public $payment_zone;
    public $payment_zone_id;
    public $payment_address_format;
    public $payment_method;
    public $payment_code;
    public $shipping_firstname;
    public $shipping_lastname;
    public $shipping_company;
    public $shipping_telephone;
    public $shipping_address_1;
    public $shipping_address_2;
    public $shipping_city;
    public $shipping_postcode;
    public $shipping_country;
    public $shipping_country_id;
    public $shipping_zone;
    public $shipping_zone_id;
    public $shipping_address_format;
    public $shipping_method;
    public $shipping_code;
    public $comment;
    public $total;
    public $order_status_id;
    public $affiliate_id;
    public $commission;
    public $language_id;
    public $currency_id;
    public $currency_code;
    public $currency_value;
    public $ip;
    public $forwarded_ip;
    public $user_agent;
    public $accept_language;
    public $created_at;
    public $updated_at;
    public $_cart =[];
    public $BillingInfoAsShippingAddress;
    public $created_by;
    public $updated_by;


    const SCENARIO_TRIAL = 'trial';
    const SCENARIO_CHECKOUT = 'checkout';

    public $_mol_pay_tx_data=[];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CHECKOUT] = ['telephone','email','payment_firstname','payment_lastname'];
        $scenarios[self::SCENARIO_TRIAL] = ['firstname','lastname','email'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname','lastname','email'],'required','on'=>self::SCENARIO_TRIAL],
            [['firstname','lastname','telephone','email'],'required','on'=>self::SCENARIO_CHECKOUT],
            [['invoice_no', 'store_id', 'user_id', 'payment_country_id', 'payment_zone_id', 'shipping_country_id', 'shipping_zone_id', 'order_status_id', 'affiliate_id', 'language_id', 'currency_id', 'created_at', 'updated_at'], 'integer'],
            [['invoice_prefix', 'store_name', 'store_url', 'firstname', 'lastname', 'email', 'telephone','payment_telephone','shipping_telephone', 'fax', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_company_id', 'payment_tax_id', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_country_id', 'payment_zone', 'payment_zone_id', 'payment_address_format', 'payment_method', 'payment_code', 'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_country_id', 'shipping_zone', 'shipping_zone_id', 'shipping_address_format', 'shipping_method', 'shipping_code', 'comment', 'affiliate_id', 'commission', 'language_id', 'currency_id', 'currency_code', 'ip', 'forwarded_ip', 'user_agent', 'accept_language', 'created_at', 'updated_at'], 'required'],
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
            [['ip', 'forwarded_ip'], 'string', 'max' => 40],
            ['BillingInfoAsShippingAddress','integer']
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
            'firstname' => Yii::t('app', 'First Name'),
            'lastname' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
            'fax' => Yii::t('app', 'Fax'),
            'payment_firstname' => Yii::t('app', 'Payment Firstname'),
            'payment_lastname' => Yii::t('app', 'Payment Lastname'),
            'payment_company' => Yii::t('app', 'Payment Company'),
            'payment_telephone' => Yii::t('app', 'Payment Telephone'),
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
            'shipping_telephone' => Yii::t('app', 'Shipping Telephone'),
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
        ];
    }

    public function BillDescription()
    {
        $temp = [];
        $cart =  unserialize(Yii::$app->db->createCommand('select cart from user where id=:id')->bindValue(':id',Yii::$app->user->id)->queryColumn()[0]);
        foreach($cart['data'] as $key => $value)
        {
            $temp[] = $value['name'] . ' x ' . $value['count'];
        }
        return implode("\n",$temp);
    }

    public function save()
    {
        $order = new Order();
        $order->loadDefaultValues();
        $order->invoice_no = 0;
        $order->invoice_prefix = date("Y-m-d").'-00';;
        $order->store_name = 'Hybrizy';
        if($this->scenario == self::SCENARIO_TRIAL)
        {
            $order->payment_method = "Trial";
            $order->payment_code = "Trial";
            $order->firstname = $this->firstname;
            $order->lastname = $this->lastname;
        }
        elseif($this->scenario === self::SCENARIO_CHECKOUT)
        {
            $order->payment_method = "MOLPay";
            $order->payment_code = "molpay";
            $order->telephone = $this->telephone;
            $order->firstname = Yii::$app->user->identity->profile->firstname;
            $order->lastname = Yii::$app->user->identity->profile->lastname;
            $order->payment_firstname = $this->payment_firstname;
            $order->payment_lastname = $this->payment_lastname;
            $order->lastname = $this->payment_lastname;
            $order->email = $this->email;
            $order->total = $this->total;


        }

        $order->store_url= Url::base(true);;
        $order->user_id = Yii::$app->user->id;

        if($order->save())
        {
            if($this->scenario === self::SCENARIO_CHECKOUT)
            {
                // Generate VCode
                $amount = $order->total;
                $merchantID = Yii::$app->params['merchantID'];
                $orderid = $order->invoice_prefix.'-'.$order->id;
                $vcode = md5($amount.$merchantID.$orderid.Yii::$app->params['verifyKey']);
                // MOLPay Tx Data setup
                $this->_mol_pay_tx_data['bill_name'] = $order->payment_firstname . ' ' . $order->payment_lastname;
                $this->_mol_pay_tx_data['bill_desc'] = $this->BillDescription();
                $this->_mol_pay_tx_data['orderid'] = $orderid;
                $this->_mol_pay_tx_data['amount'] = $order->total;
                $this->_mol_pay_tx_data['bill_email'] = $order->email;
                $this->_mol_pay_tx_data['currency'] = 'MYR';
                $this->_mol_pay_tx_data['country'] = 'MY';
                $this->_mol_pay_tx_data['bill_mobile'] = $order->telephone;
                $this->_mol_pay_tx_data['vcode'] = $vcode;
            }

            return $order;
        }

        else
            return false;

    }

    public function getMolPayTxData()
    {
        return $this->_mol_pay_tx_data;
    }


}
