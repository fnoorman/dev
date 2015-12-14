<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $telephone
 * @property string $fax
 * @property string $payment_firstname
 * @property string $payment_lastname
 * @property string $payment_company
 * @property string $payment_company_id
 * @property string $payment_address_1
 * @property string $payment_address_2
 * @property string $payment_city
 * @property string $payment_postcode
 * @property string $payment_country
 * @property integer $payment_country_id
 * @property string $shipping_firstname
 * @property string $shipping_lastname
 * @property string $shipping_company
 * @property string $shipping_address_1
 * @property string $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_postcode
 * @property string $shipping_country
 * @property integer $shipping_country_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $user
 */
class ProfileForm extends \yii\base\Model
{

    public $user_id;
    public $firstname;
    public $lastname;
    public $email;
    public $telephone;
    public $fax;
    public $payment_firstname;
    public $payment_lastname;
    public $payment_company;
    public $payment_company_id;
    public $payment_address_1;
    public $payment_address_2;
    public $payment_city;
    public $payment_postcode;
    public $payment_country;
    public $payment_country_id;
    public $shipping_firstname;
    public $shipping_lastname;
    public $shipping_company;
    public $shipping_address_1;
    public $shipping_address_2;
    public $shipping_city;
    public $shipping_postcode;
    public $shipping_country;
    public $shipping_country_id;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $updated_by;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'telephone'],'required'],
            [['payment_country_id', 'shipping_country_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'telephone', 'fax', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_company_id', 'shipping_firstname', 'shipping_lastname', 'shipping_company'], 'string', 'max' => 32],
            [['fax', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_company_id', 'shipping_firstname', 'shipping_lastname', 'shipping_company'], 'default'],
            [['payment_address_1', 'payment_address_2', 'payment_city', 'payment_country', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_country'], 'string', 'max' => 128],
            [['payment_address_1', 'payment_address_2', 'payment_city', 'payment_country', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_country'], 'default'],
            [['payment_postcode', 'shipping_postcode'], 'string', 'max' => 10],
            [['payment_postcode', 'shipping_postcode'], 'default'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'user_id' => Yii::t('app', 'User ID'),
            'firstname' => Yii::t('app', 'First Name'),
            'lastname' => Yii::t('app', 'Last Name'),
            'telephone' => Yii::t('app', 'Telephone'),
            'fax' => Yii::t('app', 'Fax'),
            'payment_firstname' => Yii::t('app', 'First Name'),
            'payment_lastname' => Yii::t('app', 'Last Name'),
            'payment_company' => Yii::t('app', 'Company'),
            'payment_company_id' => Yii::t('app', 'Company ID'),
            'payment_address_1' => Yii::t('app', 'Address 1'),
            'payment_address_2' => Yii::t('app', 'Address 2'),
            'payment_city' => Yii::t('app', 'City'),
            'payment_postcode' => Yii::t('app', 'Postcode'),
            'payment_country' => Yii::t('app', 'Country'),
            'payment_country_id' => Yii::t('app', 'Country ID'),
            'shipping_firstname' => Yii::t('app', 'First Name'),
            'shipping_lastname' => Yii::t('app', 'Last Name'),
            'shipping_company' => Yii::t('app', 'Company'),
            'shipping_address_1' => Yii::t('app', 'Address 1'),
            'shipping_address_2' => Yii::t('app', 'Address 2'),
            'shipping_city' => Yii::t('app', 'City'),
            'shipping_postcode' => Yii::t('app', 'Postcode'),
            'shipping_country' => Yii::t('app', 'Country'),
            'shipping_country_id' => Yii::t('app', 'Country ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }


    public function save()
    {
        $user = User::findOne(Yii::$app->user->id);
        $model = new Profile();
        $model->loadDefaultValues();
        $model->attributes = $this->attributes;
        try {
            return $model->link('user',$user);
        } catch (ErrorException $e) {
            echo $e->getMessage();
        }


    }


}
