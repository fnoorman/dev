<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 10/2/15
 * Time: 11:05 AM
 */

namespace common\models;

use yii\db\ActiveQuery;

class CodeBankQuery extends ActiveQuery
{
    public function used($used = false)
    {
        if($used)
            return $this->andWhere(['used'=>1]);
        else
            return $this->andWhere(['used'=>0]);
    }
}