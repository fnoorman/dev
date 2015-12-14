<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Lookup]].
 *
 * @see Lookup
 */
class LookupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Lookup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Lookup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }





}