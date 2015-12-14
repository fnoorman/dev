<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DropzoneUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/assets';
    public $baseUrl = '@web';
    public $css = [
        "css/vimeo.css"
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
