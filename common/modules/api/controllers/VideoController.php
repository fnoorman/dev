<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/20/15
 * Time: 1:01 PM
 */

/* @var $op common\models\OrderProduct */
/* @var $package common\models\Package */

namespace common\modules\api\controllers;

use common\models\Video;
use Vimeo\Vimeo;
use yii\rest\Controller;
use Yii;

class VideoController extends Controller
{
    public function actionAddVideo($videoId,$size)
    {
        $lib = new Vimeo(Yii::$app->params['vimeoClientId'],Yii::$app->params['vimeoSecret'],Yii::$app->params['vimeoAccessToken']);
        $video = new Video();
        $video->videoId = $videoId;
        $video->size =$size;

        $response = $lib->request('/me/videos/'.$videoId, [], 'GET');
        $video->duration = $response['body']['duration'];
        $video->embed = $response['body']['embed']['html'];
        $files = $response['body']['files'];
        $temp =[];
        foreach($files as $key=>$value)
        {
            switch($value['quality']){
                case 'mobile':
                    $video->mobileLink = $value['link'];
                    break;
                case 'sd':
                    $video->sdLink = $value['link'];
                    break;
                case 'hls':
                    $video->hlsLink = $value['link'];
                    break;
            }
        }


        return $response['body']['stats']['plays'];
    }
}