<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'api' => [
            'class' => 'common\modules\api\Module',

        ],
        'redactor' => [
            'class'=>'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/review',
            'uploadUrl' => '@web/review',
            'imageAllowExtensions'=>['jpg','png','gif']
        ]


    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'common\components\Authorization',
        ],
        'assetManager' => [
            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => '@themes/unify/basic/assets/plugins/jquery',
//                    'js'=>['jquery.min.js']
////                    'js'=>[],
//                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
            'appendTimestamp' => false,
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '<span class="label label-danger">NOT SET</span>',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'RM',

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/cart'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/video'],
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // the application component ID of the DB connection. Defaults to 'db'.
            // 'sessionTable' => 'my_session', // session table name. Defaults to 'session'.
        ],
    ],
];
