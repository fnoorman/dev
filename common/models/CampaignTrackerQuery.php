<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CampaignTracker]].
 *
 * @see CampaignTracker
 */
class CampaignTrackerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CampaignTracker[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CampaignTracker|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}