<?php

namespace common\html_constructor\controllers\api;

/**
 * This is the class for REST controller "HcBlockController".
 */

use common\html_constructor\models\HcBlock;

class HcBlockController extends \yii\rest\ActiveController
{
	public $modelClass = HcBlock::class;
	public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
}
