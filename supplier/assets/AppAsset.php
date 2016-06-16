<?php

namespace supplier\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'adminlte/font-awesome/css/font-awesome.css',
        'adminlte/css/AdminLTE.min.css',
        'adminlte/css/skins/_all-skins.min.css',
    ];
    public $js = [
        'adminlte/js/bootstrap.min.js',
        'adminlte/js/jquery-ui.min.js',
        'adminlte/js/app.min.js',
        'plugins/layer/layer.js',
        'plugins/cityselect/js/city.min.js',
        'plugins/cityselect/js/jquery.cityselect.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
