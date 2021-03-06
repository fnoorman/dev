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
class CustomScrollBarAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/assets';
    public $baseUrl = '@web';
    public $css = [
        "plugins/scrollbar/css/jquery.mCustomScrollbar.css",
        "css/pages/profile.css",
    ];
    public $js = [
        "plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"
    ];
    public $depends = [
        'common\assets\BasicPluginUnifyAsset',
    ];
}
