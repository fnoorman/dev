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
class HeaderAndFooterUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic';
    public $baseUrl = '@web';
    public $css = [
        "assets/css/headers/header-v3.css",
        "assets/css/footers/footer-v1.css",
    ];
    public $js = [

    ];
    public $depends = [
        'common\assets\BasicUnifyAsset'
    ];
}
