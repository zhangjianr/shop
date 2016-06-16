<?php
namespace common\controllers;

use Yii;
use yii\web\Controller;
use common\models\Wechat;
use dosamigos\qrcode\QrCode;


class ShorturlController extends Controller
{

    /**
     * @param $long_url
     * @return mixed
     * @author zhangjian
     * 微信长链接转短连接
     */
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

    /**
     * @param $url
     * @author zhangjian
     * 生成二维码
     */
    public function urlqrcode($url)
    {
        $shorturl = self::shorturl($url);
        return QrCode::jpg($shorturl);
    }

    /**
     * @param $url
     * @author zhangjian
     * 请求授权的网页 获取code
     */
    public function authorizationurl($url)
    {
        $authorizationurl = Yii::$app->params['codepath'].Yii::$app->params['appid'].'&redirect_uri='. urlencode($url).'&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect';
        return self::urlqrcode($authorizationurl);
    }

    /**
     * @param $code
     * @return mixed
     * @author zhangjian
     *请求授权网页获取 Accesstoken
     */
    public function accesstoken($code)
    {
        $url = Yii::$app->params['webaccesstokenpath'] . Yii::$app->params['appid'] .'&secret='. Yii::$app->params['secret'] .'&code='. $code .'&grant_type=authorization_code';
        return Wechat::getHttpscurl($url);
    }

    /**
     * @param $refreshtoken
     * @author zhangjian
     * 刷新网页授权 Accesstoken
     */
    public function refreshtoken($refreshtoken)
    {
        $url = Yii::$app->params['refreshtokenpath'] . Yii::$app->params['appid'] .'&grant_type=refresh_token&refresh_token='.$refreshtoken;
        return Wechat::getHttpscurl($url);
    }

    /**
     * @param $access_token
     * @author zhangjian
     * 判断网页access_token 是否有效
     */
    public function ifaccesstoken($access_token,$openid)
    {
        $url = Yii::$app->params['ifaccesstokenpath'].$access_token.'&openid='.$openid;
        return Wechat::getHttpscurl($url)->errcode;
    }

    /**
     * @param $code
     * @return mixed
     * @author zhangjian
     */
    public function getwebuserinfo($code)
    {
        $data = self::accesstoken($code);
        $result = self::ifaccesstoken($data->access_token, $data->openid);
        if($result == 0){
            $url = Yii::$app->params['webuserpath'] . $data->access_token .'&openid='. $data->openid .'&lang=zh_CN';
            return Wechat::getHttpscurl($url);
        }else{
            self::getwebuserinfo($code);
        }
    }

}