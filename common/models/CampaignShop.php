<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%campaign_shop}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $campaign_id
 * @property string $item_name
 * @property string $item_description
 * @property string $item_img
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class CampaignShop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaign_shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'campaign_id', 'item_name', 'item_description', 'item_img', 'status', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'campaign_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['item_img'], 'string'],
            [['item_name'], 'string', 'max' => 121],
            [['item_description'], 'string', 'max' => 1321]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'campaign_id' => Yii::t('app', 'Campaign ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'item_description' => Yii::t('app', 'Item Description'),
            'item_img' => Yii::t('app', 'Item Img'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CampaignShopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampaignShopQuery(get_called_class());
    }
}
