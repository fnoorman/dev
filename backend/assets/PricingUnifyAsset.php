<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PricingUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/One-Page/assets';
    public $baseUrl = '@web';
    public $css = [
        "css/pages/page_pricing.css",
    ];
    public $js = [

    ];
    public $depends = [
        'common\assets\BlueUnifyAsset',
    ];
}
