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
class StepsUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/steps/assets';
    public $baseUrl = '@web';
    public $css = [
        "css/plugins/iCheck/custom.css",
        "css/plugins/steps/jquery.steps.css"
    ];
    public $js = [
        "js/plugins/staps/jquery.steps.min.js",
        "js/plugins/validate/jquery.validate.min.js"
    ];
    public $depends = [

    ];
}
