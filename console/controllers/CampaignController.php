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
use common\models\Video;
use common\models\CodeBankCampaign;
use Yii;

class CampaignController extends Controller
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

    public function actionCreate()
    {
        $video= new Video();
        $video->loadDefaultValues();
        $video->videoId = '146751001';
        $video->mobileLink = "https://player.vimeo.com/external/146751001.mobile.mp4?s=0b43d0d45d443d1850e290c950ab621e977d5cb2&profile_id=116";
        $video->sdLink = "https://player.vimeo.com/external/146751001.sd.mp4?s=ae3d3e9818788730b24d5aafa31fd10d6cee87b0&profile_id=112";
        $video->hlsLink ="https://player.vimeo.com/external/146751001.m3u8?p=high,standard,mobile&s=5100ac376ddb43addfe9e185b93075eb83ffd519";
        $video->embed = "<iframe src=\"https://player.vimeo.com/video/146751001?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0\" width=\"854\" height=\"480\" frameborder=\"0\" title=\"EVAW LoRes\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
        $video->duration = 221;
        $video->poster = "https://i.vimeocdn.com/video/545226406_640x360.jpg?r=pad";
        $video->size =10;
        $video->created_by = 7;
        $video->updated_by = 7;
        $video->save();
        $cb = new CodeBankCampaign();
        $cb->loadDefaultValues();
        $cb->name ='Violence Against Women';
        $cb->modelClass = 'Video';
        $cb->objectId = $video->id;
        $cb->codeBank_code = 'EVAW';
        $cb->created_by = 7;
        $cb->updated_by = 7;
        $cb->save();
        echo "Done\n";

    }

    public static function actionGenerateMinusDays($duration,$currentIntegerDate = null)
    {
        $date = date_create();
        $current = date_format($date,'Y-m-d H:i:s');
//        echo date('U', strtotime($current. ' - '.$duration.' days'));
//        echo "\n";
//        echo date('Y-m-d H:i:s', strtotime($current. ' - '.$duration.' days'));
//        echo "\n";

        for($i=0;$i < $duration-1 + 1;$i++)
        {
            $temp[]= date('d-m-Y', strtotime($current. ' - '.$i.' days'));
        }
//        var_dump($temp);
//        echo "\n";
        return $temp;
    }






}