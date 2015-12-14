<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CampaignShop]].
 *
 * @see CampaignShop
 */
class CampaignShopQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CampaignShop[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CampaignShop|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}