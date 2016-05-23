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

            $tmpArr = array($token, $timestamp, $nonce);
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode( $tmpArr );
            $tmpStr = sha1( $tmpStr );

            if($tmpStr == $signature){
                //$this->actionReponsemsg();
                echo $echoStr;
                exit;
            }
        }

        public function actionReponsemsg()
        {
            $arr = $GLOBALS['HTTP_RAW_POST_DATA'];
            $wxobj = simplexml_load_string($arr);
            $fromuser = $wxobj->ToUserName;
            $touser = $wxobj->FromUserName;
            $content = '回复内容';
            $template = '<xml>
 <ToUserName><![CDATA[%s]]></ToUserName>
 <FromUserName><![CDATA[%s]]></FromUserName>
 <CreateTime>%s</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[%s]]></Content>
 </xml>';






            $info = sprintf($template,$touser,$fromuser,time(),$content);
            echo info;
//            switch ( strtolower($wxobj->MsgType) ){
//                case 'news':;
//                    break;
//                case 'text':
//                    $this->actionTextmsg($wxobj);
//                    break;
//                case 'event':
////                     if( strtolower($wxobj->Event) == 'subscribe'){
//                        $this->actionTextmsg($wxobj);
////                     };
//                    break;
//            }

        }

        public function actionNewsmsg($wxobj)
        {

        }

        public function actionTextmsg($wxobj)
        {
            $fromuser = $wxobj->ToUserName;
            $touser = $wxobj->FromUserName;
            $content = '回复内容';
            $template = '<xml>
                     <ToUserName><![CDATA[%s]]></ToUserName>
                     <FromUserName><![CDATA[%s]]></FromUserName>
                     <CreateTime>'.time().'</CreateTime>
                     <MsgType><![CDATA[text]]></MsgType>
                     <Content><![CDATA[%s]]></Content>
                     </xml>';
            $info = sprintf($template,$touser,$fromuser,$content);
            echo info;
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