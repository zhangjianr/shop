<?php
namespace common\controllers;

use Yii;
use yii\web\Controller;
use common\models\Wechat;
use dosamigos\qrcode\QrCode;


class ShorturlController extends Controller
{

    //微信长链接转短连接
    public function shorturl($long_url)
    {
        $model = new Wechat();
        $model->getWxtokentime();
        $url = Yii::$app->params['shortUrlpath'].Yii::$app->session['token'];
        $data = ['action' => 'long2short','long_url' => $long_url];
        $jsdata = json_encode($data);
        $result = $model->getHttpscurl($url,'post',$jsdata);
        return json_decode($result)->short_url;
    }

    public function urlqrcode($url)
    {
        $shorturl = self::shorturl($url);
        return QrCode::jpg($shorturl);
    }

    public function authorizationurl($url)
    {
        $authorizationurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.Yii::$app->params['appid'].'&redirect_uri='. urlencode($url).'&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect';
        return self::urlqrcode($authorizationurl);
    }

}