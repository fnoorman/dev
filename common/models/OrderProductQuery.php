<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrderProduct]].
 *
 * @see OrderProduct
 */
use Yii;
use common\models\CodeBank;
class OrderProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function availableProduct($modelClass,$userId)
    {
        return $this->andWhere(['modelClass'=>$modelClass,'created_by'=>$userId]);
    }

    public function codes($userId)
    {
        return $this->select('codeBank.code')->join('INNER JOIN','codeBank','order_product.id=codeBank.order_product_id')->andWhere(['created_by'=>$userId])->column();
    }

    public function topups($userId)
    {
        return $this->select('toppupBank.id')
            ->join('INNER JOIN','toppupBank','order_product.id=toppupBank.order_product_id')
            ->andWhere(['order_product.created_by'=>$userId,'toppupBank.used'=>0,'order_product.modelClass'=>'Topup'])
            ->count();
    }



}