<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                '/' => 'site/index',
                ['pattern'=>'/dent/<firstLevel:\w+>/<secondLevel:\w+>/<thirdLevel:\w+>','route'=>'dent/third-level', 'suffix'=>'/'],
                ['pattern'=>'/dent/<firstLevel:\w+>/<secondLevel:\w+>','route'=>'dent/second-level', 'suffix'=>'/'],
                ['pattern'=>'/dent/<firstLevel:\w+>','route'=>'dent/first-level', 'suffix'=>'/'],
                ['pattern'=>'/specialists/<doctor:[\w-]+>','route'=>'specialists/specialist-card', 'suffix'=>'/'],
                ['pattern'=>'/speciality/<specID:[\w-]+>','route'=>'med-specialties/speciality-name', 'suffix'=>'/'],
                ['pattern'=>'/agreement/','route'=>'other/agreement', 'suffix'=>'/'],
                ['pattern'=>'/contacts/<clinic:\w+>','route'=>'other/clinic-contacts', 'suffix'=>'/'],
                ['pattern'=>'/contacts/','route'=>'other/contacts', 'suffix'=>'/'],
                ['pattern'=>'/partners/','route'=>'other/partners', 'suffix'=>'/'],
                ['pattern'=>'/price/','route'=>'other/prices', 'suffix'=>'/'],
                ['pattern'=>'/about/','route'=>'other/about', 'suffix'=>'/'],
                ['pattern'=>'/specialnoe/<deal:\w+>','route'=>'other/special-deal', 'suffix'=>'/'],
                ['pattern'=>'/specialnoe/','route'=>'other/special-deals', 'suffix'=>'/'],
                ['pattern'=>'/reviews/','route'=>'other/reviews', 'suffix'=>'/'],
                ['pattern'=>'/faq/','route'=>'other/faq', 'suffix'=>'/'],
                ['pattern'=>'/lizcenz/','route'=>'other/licenses', 'suffix'=>'/'],
                ['pattern'=>'/garantii-na-stomatologicheskie-uslugi/','route'=>'other/warranty', 'suffix'=>'/'],

            ],
        ],
    ],
    'params' => $params,
];
