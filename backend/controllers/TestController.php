<?php
//废弃页面  微信测试
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class WechatController
 * @package backend\controllers
 * @author zhangjian
 * 微信操作类
 */


class TestController extends Controller
{

    /**
     * @return int
     * @author zhangjian
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $token = 'weixin';
        $echoStr = $request->get('echostr');
        $signature = $request->get('signature');
        $timestamp = $request->get('timestamp');
        $nonce = $request->get('nonce');

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature && $echoStr) {
            echo $echoStr;
            exit;
        } else {
            $this->responseMsg($GLOBALS["HTTP_RAW_POST_DATA"]);
        }
    }

    public function responseMsg($data)
    {
        //get post data, May be due to the different environments
        $postStr = $data;

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $this->postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $this->postObj->FromUserName;
            $toUsername = $this->postObj->ToUserName;
            $keyword = trim($this->postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;exit();
            }else{
                echo "Input something...";
            }

        }else {
            echo "";
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
        $appid = 'wxce8bdf437aaefbc6';
        $secret = '278da00d4b7a53e73e6fa928fc39409f';
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