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
class BasicUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/assets';
    public $baseUrl = '@web';
    public $css = [
        "plugins/bootstrap/css/bootstrap.min.css",
        "css/style.css",
    ];
    public $js = [
//        "assets/plugins/jquery/jquery.min.js",
        "plugins/jquery/jquery-migrate.min.js",
        "plugins/bootstrap/js/bootstrap.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
