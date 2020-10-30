<?php

namespace common\html_constructor\models\utility;

use himiklab\sortablegrid\SortableGridAction;
use himiklab\sortablegrid\SortableGridBehavior;

trait SortableTrait
{
    public function sortableModelBehavior()
    {
        return
            [
                'sort' => [
                    'class' => SortableGridBehavior::class,
                    'sortableAttribute' => 'sort'
                ],
            ];
    }

    public function sortableControllerAction($modelClassname)
    {
        return [
            'sort' => [
				'class' => SortableGridAction::class,
				'modelName' => $modelClassname,
			],
        ];
    }
}
