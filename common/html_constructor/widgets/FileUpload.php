<?php

namespace common\html_constructor\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class FileUpload extends Widget
{
  public $label = 'Файлы';
  public $multiple = false;
  public $hidden = false;
  public $model;
  public $lastFiles = null;

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    return $this->render('file-upload', [
      'label' => $this->label,
      'hidden' => $this->hidden,
      'multiple' => $this->multiple,
      'model' => $this->model,
      'lastFiles' => $this->lastFiles
    ]);
  }
}
