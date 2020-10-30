<?php

use common\html_constructor\models\BaseFileEnum;
use common\html_constructor\models\HcFile;
use common\html_constructor\models\HcObjectFileTarget;
use common\html_constructor\widgets\FileUpload;

$fileEnumclass = BaseFileEnum::class;
/** @var HcObjectFileTarget */
if (!$model->isNewRecord) {
    foreach ($model->fileTargets as $fileTarget) {
        echo FileUpload::widget([
            'label' => $fileEnumclass::getLabel($fileTarget->type),
            'multiple' => true,
            'hidden' => false,
            'model' => $fileTarget,
            'lastFiles' => HcFile::find()->limit(5)->orderBy('id DESC')->all()
        ]);
    }
} else {
    echo '<div class="callout callout-warning mt-20">Сначала нужно сохранить объект!</div>';
}
