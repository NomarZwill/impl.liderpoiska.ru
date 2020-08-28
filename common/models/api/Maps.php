<?php

namespace common\models\api;

use Yii;
use yii\base\BaseObject;
use backend\models\Clinics;

class Maps extends BaseObject{

  public $geoObjects;

  public function __construct() {
    $clinics = Clinics::find()->all();

    $this->geoObjects = [
			'type' => 'FeatureCollection',
			'features' => []
    ];
    
    foreach ($clinics as $clinic) {
      array_push($this->geoObjects['features'], [
        'type' => "Feature",
	            'id' => $clinic->clinic_id,
	            'geometry' => [
	              'type' => "Point",
	              'coordinates' => [$clinic->clinic_latitude, $clinic->clinic_longitude]
	            ],
	            'properties' => [
	              'organization' => $clinic->clinic_title,
                'address' => $clinic->clinic_address,
                'phone' => $clinic->clinic_phone,
                'workHours' => $clinic->clinic_opening_hours,
	              'alias' => $clinic->alias,
	            ]
			
      ]);
    }
  }
}