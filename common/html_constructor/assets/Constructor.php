<?php

namespace common\html_constructor\assets;

use dmstr\web\AdminLteAsset;
use kartik\file\FileInputAsset;
use kartik\file\SortableAsset;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * React constructor application asset bundle.
 */
class Constructor extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'constructor.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        FileInputAsset::class,
        AdminLteAsset::class,
        SortableAsset::class
    ];

    public function init() {
        parent::init();
        $this->css = $this->getVersionedFiles($this->css);
        $this->js = $this->getVersionedFiles($this->js);
    }

    public function getVersionedFiles($files)
    {
        $out = [];
        foreach ($files as $file) {
            $filePath = \Yii::getAlias('@webroot/' . $file);
            $out[] = $file . (is_file($filePath) ? '?v=' . filemtime($filePath) : '');
        }
        return $out;
    }
}
