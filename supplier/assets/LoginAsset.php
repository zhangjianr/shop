<?php

namespace supplier\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'adminlte/css/AdminLTE.min.css',
        'plugins/iCheck/square/blue.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/layer/layer.js',
        'plugins/cityselect/js/city.min.js',
        'plugins/cityselect/js/jquery.cityselect.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];



}
