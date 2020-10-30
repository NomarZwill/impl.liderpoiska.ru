<?php

use common\html_constructor\models\BaseFileEnum;

$fileEnumclass = BaseFileEnum::class;

/** @var  \common\html_constructor\models\HcObjectFileTarget */
foreach ($model->fileTargets as $fileTarget) :
    $files = $fileTarget->getFileArray();
?>
    <br>
    <div class="form-group" id="<?= $model->id ?>">
        <div class="bg-light-blue disabled color-palette box-header with-border mb-20">
            <span class="label" style="font-size:14px"><?= $fileEnumclass::getLabel($fileTarget->type) ?></span>
        </div>
        <div class="row">
                <?php foreach ($files as $file) : ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 border border-primary">
                        <img class="img-thumbnail" src="<?= $file->getWebFileLink(['width' => 200, 'height' => 200], false) ?>" class="img-responsive">
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
    <br>
<?php endforeach; ?>