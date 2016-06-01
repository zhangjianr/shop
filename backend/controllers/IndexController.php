<?php
namespace backend\controllers;

use common\core\backend\BackendController;


class IndexController extends BackendController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        libxml_disable_entity_loader(true);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

        switch (strtolower($postObj->MsgType)){
            case 'text':
                $this->mesg($postObj);
                break;
            case 'event':
                if(strtolower($postObj->Event) == 'subscribe'){
                    $this->mesgsf($postObj);
                }
                break;
        }
    }

    public function mesg($postObj)
    {

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
        $msgType = "text";
        $contentStr = "hehehehehhe";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        \Yii::$app->response->content = $resultStr;

    }

    public function mesgsf($postObj)
    {

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
        $msgType = "text";
        $contentStr = "这事关注";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        \Yii::$app->response->content = $resultStr;

    }

//    public function newsmsg($postObj)
//    {
//        $fromUsername = $postObj->FromUserName;
//        $toUsername = $postObj->ToUserName;
//        $keyword = trim($postObj->Content);
//        $time = time();
//        $textTpl = "<xml>
//                    <ToUserName><![CDATA[toUser]]></ToUserName>
//                    <FromUserName><![CDATA[fromUser]]></FromUserName>
//                    <CreateTime>12345678</CreateTime>
//                    <MsgType><![CDATA[news]]></MsgType>
//                    <ArticleCount>2</ArticleCount>
//                    <Articles>
//                    <item>
//                    <Title><![CDATA[title1]]></Title>
//                    <Description><![CDATA[description1]]></Description>
//                    <PicUrl><![CDATA[picurl]]></PicUrl>
//                    <Url><![CDATA[url]]></Url>
//                    </item>
//                    <item>
//                    <Title><![CDATA[title]]></Title>
//                    <Description><![CDATA[description]]></Description>
//                    <PicUrl><![CDATA[picurl]]></PicUrl>
//                    <Url><![CDATA[url]]></Url>
//                    </item>
//                    </Articles>
//                    </xml>";
//        $msgType = "text";
//        $contentStr = "hehehehehhe";
//        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//        \Yii::$app->response->content = $resultStr;
//    }
//
//    public function textmsg($postObj)
//    {
//        $fromUsername = $postObj->FromUserName;
//        $toUsername = $postObj->ToUserName;
//        $keyword = trim($postObj->Content);
//        $time = time();
//        $textTpl = "<xml>
//                        <ToUserName><![CDATA[%s]]></ToUserName>
//                        <FromUserName><![CDATA[%s]]></FromUserName>
//                        <CreateTime>%s</CreateTime>
//                        <MsgType><![CDATA[%s]]></MsgType>
//                        <Content><![CDATA[%s]]></Content>
//                        <FuncFlag>0</FuncFlag>
//                        </xml>";
//        $msgType = "text";
//        $contentStr = "hehehehehhe";
//        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//        \Yii::$app->response->content = $resultStr;
//    }
//
//
//    /**
//     * @param $url
//     * @param string $type
//     * @param array $data
//     */
//    public function httpcurl($url,$type='get',$data='')
//    {
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1 );
//        if($type == 'post'){
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        }
//        $result = curl_exec($ch);
//        curl_close($ch);
//        return $result;
//    }
//
//    public function Wxtoken()
//    {
//        $appid = 'wxb5393e54b8e63918';
//        $secret = 'f061a8027185d4827b2da71db96a0d88';
//        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
//        $result = $this->httpcurl($url);
//        $token = json_decode($result,true);
//        Yii::$app->session['token'] = $token['access_token'];
//        Yii::$app->session['tokentime'] = time()+7200;
//    }
//
//    public function menu()
//    {
//        if(Yii::$app->session['token'] && Yii::$app->session['tokentime']>time()){
//            $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Yii::$app->session['token'];
//        }else{
//            $this->Wxtoken();
//            $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Yii::$app->session['token'];
//        }
//        $data = '{
//     "button":[
//     {
//          "type":"click",
//          "name":"今日歌曲",
//          "key":"V1001_TODAY_MUSIC"
//      },
//      {
//           "name":"菜单",
//           "sub_button":[
//           {
//               "type":"view",
//               "name":"搜索",
//               "url":"http://www.soso.com/"
//            },
//            {
//               "type":"view",
//               "name":"视频",
//               "url":"http://v.qq.com/"
//            },
//            {
//               "type":"click",
//               "name":"赞一下我们",
//               "key":"V1001_GOOD"
//            }]
//       }]
// }';
//        $re = $this->httpcurl($url,'post',$data);
//        print_r($re);
//    }




}