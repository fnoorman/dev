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
class ProfileUnifyAsset extends AssetBundle
{
    public $sourcePath = '@themes/unify/basic/assets';
    public $baseUrl = '@web';
    public $css = [
        'plugins/bootstrap/css/bootstrap.min.css',
        'css/style.css',
        'css/headers/header-default.css',
        'css/footers/footer-v1.css',
        'plugins/animate.css',
        'plugins/line-icons/line-icons.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/scrollbar/css/jquery.mCustomScrollbar.css',
        'css/pages/profile.css',
        'plugins/sky-forms-pro/skyforms/css/sky-forms.css',
        'plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css',

        'css/pages/shortcode_timeline2.css',
    ];
    public $js = [
        //'plugins/jquery/jquery.min.js',
        'plugins/jquery/jquery-migrate.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/back-to-top.js',
        'plugins/smoothScroll.js',
        'plugins/circles-master/circles.js',
        'plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js',
        'plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js',
        'plugins/sky-forms-pro/skyforms/js/jquery.form.min.js',
        'plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js',
        'js/custom.js',
        'js/app.js',
//        'js/plugins/datepicker.js',

    ];
    public $depends = [
        'yii\web\JQueryAsset'
    ];
}
