<?php

namespace common\html_constructor\controllers;

use yii\web\Controller;

abstract class BaseHcController extends Controller
{

    public function getViewPath()
    {
        return \Yii::getAlias('@common/html_constructor/views/') . $this->id;
    }

    public function beforeAction($action)
    {
        $routesAllowedForGuest = [
            'site/login',
        ];

        if (!in_array($action->controller->module->requestedRoute, $routesAllowedForGuest) && \YII::$app->user->isGuest) {
                return $this->redirect(['site/login']);
        }
        return parent::beforeAction($action);
    }
    
}
