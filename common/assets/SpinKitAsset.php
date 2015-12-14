<?php


namespace common\assets;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files required by [[Pjax]] widget.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SpinKitAsset extends AssetBundle
{
    public $sourcePath = '@bower/SpinKit/css';
    public $css = [
        'spinners/8-circle.css',
        'spinkit.css',
    ];
    public $depends = [

    ];
}
