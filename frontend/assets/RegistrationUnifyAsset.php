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
class RegistrationUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/';
    public $baseUrl = '@web';
    public $css = [
        'assets/plugins/bootstrap/css/bootstrap.min.css',

        'assets/css/style.css',

        'assets/css/headers/header-default.css',
        'assets/css/footers/footer-v1.css',
        'assets/plugins/animate.css',
        'assets/plugins/line-icons/line-icons.css',
        'assets/plugins/font-awesome/css/font-awesome.min.css',
        'assets/css/pages/page_log_reg_v1.css',
        'assets/css/theme-colors/blue.css',
        'assets/css/custom.css',
    ];
    public $js = [
        'assets/plugins/jquery/jquery.min.js',
        'assets/plugins/jquery/jquery-migrate.min.js',
        'assets/plugins/bootstrap/js/bootstrap.min.js',
        'assets/plugins/back-to-top.js',
        'assets/plugins/smoothScroll.js',
        'assets/js/custom.js',
        'assets/js/app.js',
    ];
    public $depends = [
    ];
}
