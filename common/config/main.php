<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@common/html_constructor/translations',
                    'sourceLanguage' => 'en-US',
                    'fileMap'        => [
                        'cruds' => 'cruds.php',
                        'models' => 'models.php',
                    ],
                ],
            ],
        ],

    ],
    'controllerMap' => [
        'hc-draft-blocks' => 'common\html_constructor\controllers\api\HcDraftBlockController',
        'hc-blocks' => 'common\html_constructor\controllers\api\HcBlockController',
        'hc-block' => 'common\html_constructor\controllers\HcBlockController',
        'hc-draft' => 'common\html_constructor\controllers\HcDraftController',
        'hc-draft-block' => 'common\html_constructor\controllers\HcDraftBlockController',
        'hc-tag' => 'common\html_constructor\controllers\HcTagController',
        'hc-file' => 'common\html_constructor\controllers\HcFileController',
        'hc-object-seo' => 'common\html_constructor\controllers\HcObjectSeoController',
    ],
];
