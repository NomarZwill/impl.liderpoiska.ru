<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\api\Maps;

class ApiController extends Controller
{

	public function actionMaps()
	{
		$maps = new Maps();

		// echo '<pre>';
		// print_r($maps);
		// echo '</pre>';
		// exit;

		return json_encode($maps);
	}
}