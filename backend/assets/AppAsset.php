<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'font-awesome/css/font-awesome.css',
        'adminlte/css/AdminLTE.min.css',
        'adminlte/css/skins/_all-skins.min.css',
        ];
    public $js = [
        'js/jquery-ui.min.js',
        'adminlte/js/app.min.js',
        'plugins/layer/layer.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
