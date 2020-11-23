<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'medicalSpecialties' => 'medical-specialties',
                //'<module:gii>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                [
                    'pattern'=>'/update',
                    'route'=>'site/index'
                ],
                [
                    'pattern' => '/doctors/<event_id:\d+>/delete-gallery-lizcenz-image/<image_id:\d+>',
                    'route' => 'doctors/delete-gallery-lizcenz-image',
                    'suffix' => '/'
                ],
                [
                    'pattern' => '/clinics/<event_id:\d+>/delete-gallery-image/<image_id:\d+>',
                    'route' => 'clinics/delete-gallery-image',
                    'suffix' => '/'
                ],
                [
                    'pattern' => '/licenses-documents-page/<event_id:\d+>/delete-gallery-image/<image_id:\d+>',
                    'route' => 'licenses-documents-page/delete-gallery-image',
                    'suffix' => '/'
                ],
                [
                    'pattern' => '/licenses-documents-page/<event_id:\d+>/delete-document/<doc_id:\d+>',
                    'route' => 'licenses-documents-page/delete-document',
                    'suffix' => '/'
                ],
                [
                    'pattern' => '<controller>/<id:\d+>/<action>',
                    'route' => '<controller>/<action>',
                    'suffix' => '/'
                ],
                [
                    'pattern' => 'hc-file/<id:\d+>/resort/<sort:\d+>',
                    'route' => 'hc-file/resort',
                    'suffix' => '/'
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'hc-blocks',
                    'suffix' => '/',
                    'except' => ['delete', 'create', 'update'],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'hc-draft-blocks',
                    'suffix' => '/',
                    'extraPatterns' => [
                        'POST sort' => 'sort',
                    ]
                ],

            ],
            
        ],
        
    ],
    'params' => $params,
];
