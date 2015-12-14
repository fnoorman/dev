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
class MasonryUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/assets';
    public $baseUrl = '@web';
    public $css = [
        "css/pages/blog_masonry_3col.css",
    ];
    public $js = [
        //'js/pages/blog-masonry.js',
    ];
    public $depends = [
        'common\assets\ProfileUnifyAsset',
        //'yii\web\JqueryAsset',
    ];
}
