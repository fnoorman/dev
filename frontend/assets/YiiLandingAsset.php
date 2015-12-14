<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * This asset bundle provides the base javascript files for the Yii Framework.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class YiiLandingAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];
    public $depends = [

    ];
}
