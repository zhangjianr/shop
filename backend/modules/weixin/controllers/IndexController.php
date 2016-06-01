<?php
namespace backend\modules\weixin\controllers;

use Yii;
use backend\models\Keyword;
use backend\models\Wxlinkreply;
use backend\models\Wxmenu;
use backend\models\Wxnewreply;
use backend\models\Wxreply;
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
                $this->reponsemsg($postObj);
                break;
            case 'event':
                switch (strtolower($postObj->Event)){
                    case 'subscribe':
                        $this->reponsemsg($postObj,'关注回复');
                        break;
                    case 'click':
                        $this->reponsemsg($postObj,$postObj->EventKey);
                        break;
                }
                break;
        }
    }

    public function reponsemsg($postObj,$content='')
    {
        if($content){
            if($content > 0){
                $arr = Keyword::findOne(['id'=>$content]);
                if($arr['status'] == 1){//文本回复
                    $this->textmsg($postObj,$arr['id']);
                }elseif ($arr['status'] == 2){//图文回复
                    $this->newsmsg($postObj,$arr['id']);
                }elseif ($arr['status'] == 3){//链接回复
                    $this->linkmsg($postObj,$arr['id']);
                }
            }else{
                $arr = Keyword::findOne(['keyword'=>$content]);

                if($arr['status'] == 1){//文本回复
                    $this->textmsg($postObj,$arr['id']);
                }elseif ($arr['status'] == 2){//图文回复
                    $this->newsmsg($postObj,$arr['id']);
                }elseif ($arr['status'] == 3){//链接回复
                    $this->linkmsg($postObj,$arr['id']);
                }
            }
        }else{
            $where = trim($postObj->Content);
            $arr = Keyword::findOne(['keyword'=>$where]);

            if($arr['status'] == 1){//文本回复
                $this->textmsg($postObj,$arr['id']);
            }elseif ($arr['status'] == 2){//图文回复
                $this->newsmsg($postObj,$arr['id']);
            }elseif ($arr['status'] == 3){//链接回复
                $this->linkmsg($postObj,$arr['id']);
            }
        }
    }

    /**
     * 文本回复
     * @author zhangjian
     */
    public function textmsg($postObj,$kid)
    {
        $result = Wxnewreply::findOne(['kid'=>$kid]);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        $contentStr = $result->content;
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $contentStr);
        \Yii::$app->response->content = $resultStr;
    }

    /**
     * 图文回复
     * @author zhangjian
     */
    public function newsmsg($postObj,$kid)
    {
        $result = Wxreply::find()->where(['kid'=>$kid])->asArray()->orderBy('sort')->all();
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $count = count($result);
        $newsTpl ="<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>";
        foreach ($result as $val){
            $newsTpl .=  "<item>
                          <Title><![CDATA[".$val['title']."]]></Title> 
                          <Description><![".$val['description']."]]></Description>
                          <PicUrl><![CDATA[".Yii::$app->params['picPath'].$val['picurl']."]]></PicUrl>
                          <Url><![CDATA[".$val['url']."]]></Url>
                          </item>";
        }
        $newsTpl .="
                    </Articles>
                    </xml>";
        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $count);
        \Yii::$app->response->content = $resultStr;
    }

    /**
     * 链接回复
     * @author zhangjian
     */
    public function linkmsg($postObj,$kid)
    {
        $result = Wxlinkreply::findOne(['kid'=>$kid]);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $linkTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>".time()."</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
        $contentStr = "<a href='".$result->link."'>".$result->content."</a>";
        $resultStr = sprintf($linkTpl, $fromUsername, $toUsername, $contentStr);
        \Yii::$app->response->content = $resultStr;

    }

    /**
     * curl提交
     * @param $url
     * @param string $type
     * @param string $data
     * @return mixed
     * @author zhangjian
     */
    public function httpcurl($url,$type='get',$data='')
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

    /**
     * 获取微信token
     * @author zhangjian
     */
    public function Wxtoken()
    {
        $appid = Yii::$app->params['appid'];
        $secret = Yii::$app->params['secret'];
        $url = Yii::$app->params['tokenpath'].$appid.'&secret='.$secret;
        $result = $this->httpcurl($url);
        $token = json_decode($result,true);
        Yii::$app->session['token'] = $token['access_token'];
        Yii::$app->session['tokentime'] = time()+7200;
    }

    /**
     * 请求微信生成自定义菜单
     * @author zhangjian
     */
    public function actionMenu()
    {
        //判断token是否超过了两小时
        if(Yii::$app->session['token'] && Yii::$app->session['tokentime']>time()){
            $url = Yii::$app->params['wxmenupath'].Yii::$app->session['token'];
        }else{
            $this->Wxtoken();
            $url = Yii::$app->params['wxmenupath'].Yii::$app->session['token'];
        }

        $arr = Wxmenu::find()->where(['superior'=>0])->orderBy('sort')->asArray()->all();
        $jsonx = array();
        foreach ($arr as $v){
            if(empty($v['type'])){
                $data = Wxmenu::find()->where(['superior'=>$v['id']])->asArray()->all();
                $xarr = array();
                foreach ($data as $item) {
                    if($item['type'] == 'click'){
                        $xarr[] = array('type'=>$item['type'],'name'=>urlencode($item['name']),'key'=>$item['kid']);
                    }else{
                        $xarr[] = array('type'=>$item['type'],'name'=>urlencode($item['name']),'url'=>$item['url']);
                    }
                }if(count($xarr) > 1){
                    $warr = array('name'=>urlencode($v['name']),'sub_button'=>$xarr);
                    $jsonx[] = $warr;
                }
            }elseif($v['type'] == 'click'){
                $jsonx[] = array('type'=>$v['type'],'name'=>urlencode($v['name']),'key'=>$v['kid']);
            }elseif($v['type'] == 'view'){
                $jsonx[] = array('type'=>$v['type'],'name'=>urlencode($v['name']),'url'=>$v['url']);
            }
        }
        $jsondata = urldecode(json_encode(array('button'=>$jsonx)));
        $this->httpcurl($url,'post',$jsondata);
        Yii::$app->session->setFlash('cremenu',1);
        return $this->redirect('index.php?r=/weixin/wxmenu/index');
    }

}