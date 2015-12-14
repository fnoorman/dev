<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BasicPluginUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic';
    public $baseUrl = '@web';
    public $css = [
        "assets/plugins/animate.css",
        "assets/plugins/line-icons/line-icons.css",
        "assets/plugins/font-awesome/css/font-awesome.min.css",
    ];
    public $js = [
        "assets/plugins/back-to-top.js",
        "assets/plugins/smoothScroll.js",
        "assets/plugins/jquery.parallax.js",
    ];
    public $depends = [
        'common\assets\HeaderAndFooterUnifyAsset'
    ];
}
