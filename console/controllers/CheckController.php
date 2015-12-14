<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/18/15
 * Time: 5:41 PM
 */

namespace console\controllers;

use yii\console\Controller;
use common\modules\api\controllers\ProcessOrderController;
use common\models\CampaignTracker;

class CheckController extends Controller
{

    /**
     * @param $dateInteger timestamp in integer format
     */
    public function actionExpiredDate($dateInteger,$echo=false)
    {
        if($echo)
            echo "Expired: ".date('Y-m-d h:i:s',$dateInteger)."\n";
        else
            return date('Y-m-d h:i:s',$dateInteger);
    }

    public function actionGenerateExpiredDate($duration)
    {
        $expired = ProcessOrderController::GenerateExpiredBy($duration);
        $result = $this->actionExpiredDate($expired);
        echo "Duration: $result\n";
    }

    public function actionUniqueByCode($code)
    {
        echo "Unique count for ". $code .' is ';
        echo CampaignTracker::uniqueByCode(strtoupper($code));
        echo "\n";
    }


}