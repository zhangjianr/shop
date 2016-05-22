<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

    /**
     * Class WechatController
     * @package backend\controllers
     * @author zhangjian
     * 微信操作类
     */


    class WechatController extends Controller
    {

        /**
         * @return int
         * @author zhangjian
         */
        public function actionConf()
        {
            $request = Yii::$app->request;

            $token = 'weixin';
            $echoStr = $request->get('echostr');
            $signature = $request->get('signature');
            $timestamp = $request->get('timestamp');
            $nonce = $request->get('nonce');

            $arr = array($token, $timestamp, $nonce);
            sort($arr, SORT_STRING);
            $arrstr = implode( $arr );
            $arrstr = sha1( $arrstr );
            if($arrstr == $signature){
                echo $echoStr;
                exit;
            }
        }

        /**
         * @param $url
         * @param string $type
         * @param array $data
         */
        public function actionHttpcurl($url,$type='get',$data='')
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1 );
            if($type == 'post'){
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        public function actionWxtoken()
        {
            $appid = 'wxb5393e54b8e63918';
            $secret = 'f061a8027185d4827b2da71db96a0d88';
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
            $result = $this->actionHttpcurl($url);
            $token = json_decode($result,true);
            Yii::$app->session['token'] = $token['access_token'];
            Yii::$app->session['tokentime'] = time()+7200;
        }

        public function actionMenu()
        {
            if(Yii::$app->session['token'] && Yii::$app->session['tokentime']>time()){
                $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Yii::$app->session['token'];
            }else{
                $this->actionWxtoken();
                $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Yii::$app->session['token'];
            }
            $data = '{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';
            $re = $this->actionHttpcurl($url,'post',$data);
print_r($re);
        }
    }