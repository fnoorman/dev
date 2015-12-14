<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ToppupBank]].
 *
 * @see ToppupBank
 */
class TopupBankQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ToppupBank[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ToppupBank|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function used($used=1)
    {
        return $this->andWhere(['used'=>$used]);
    }
}