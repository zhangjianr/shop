<?php
namespace backend\modules\weixin\controllers;

use Yii;
use yii\web\Controller;
use backend\models\User;
use common\models\Image;
use backend\models\Person;
use backend\models\Wxmenu;
use backend\models\Keyword;
use backend\models\Wxreply;
use backend\models\WxWelcome;
use backend\models\Wxnewreply;
use backend\models\WxReplyMult;

class IndexController extends Controller
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
                        if(!empty($postObj->EventKey)){
                            $this->getuserinfo($postObj);
                        }else{
                            $this->getuserinfo($postObj);
                        }
                        break;
                    case 'scan':
                        $this->getuserinfo($postObj);
                        break;
                    case 'click':
                        $this->reponsemsg($postObj);
                        break;
                }
                break;
        }
    }

    /**
     * @param $postObj
     * @author zhangjian
     * 文本消息
     */
    public function reponsemsg($postObj)
    {
        $where = trim($postObj->Content);
        $arr = Keyword::findOne(['keyword'=>$where]);
        if($arr->status == 1){//文本回复
            $this->textmsg($postObj,$arr->rid);
        }elseif ($arr->status == 2){//图文回复
            $this->newmsg($postObj,$arr->rid);
        }elseif ($arr->status == 3){//多图文回复
            $this->newsmsg($postObj,$arr->rid);
        }
    }

    /**
     * @author zhangjian
     * 欢迎消息
     */
    public function submsg($postObj)
    {
        $model = WxWelcome::findOne(1);
        if($model->type == 3){
            $this->newsmsg($postObj,$model->kid);
        }elseif ($model->type == 3){
            $this->newmsg($postObj,$model->kid);
        }else{
            $this->textmsg($postObj,$model->kid);
        }
    }

    /**
     * 文本回复
     * @author zhangjian
     */
    public function textmsg($postObj,$id)
    {
        $result = Wxnewreply::findOne($id);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
        $contentStr = $result->content;
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $contentStr);
        echo $resultStr;
    }

    /**
     * 图文回复
     * @author zhangjian
     */
    public function newmsg($postObj,$id)
    {
        $result = Wxreply::findOne($id);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $newsTpl ="<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>1</ArticleCount>
                    <Articles>
                    <item>
                    <Title><![CDATA[%s]]></Title> 
                    <Description><![%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                    </item>
                    </Articles>
                    </xml>";
        $img = Image::getImage($result->image_id);
        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername,$result->title,$result->description,$img,$result->url);
        echo $resultStr;
    }

    /**
     * 多图文图文回复
     * @author zhangjian
     */
    public function newsmsg($postObj,$id)
    {

        $arr = WxReplyMult::findOne($id);
        $result = Wxreply::keyname($arr->mult_ids);
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
                          <Title><![CDATA[". $val->title ."]]></Title>
                          <Description><![". $val->description ."]]></Description>
                          <PicUrl><![CDATA[". Image::getImage($val->image_id) ."]]></PicUrl>
                          <Url><![CDATA[". $val->url ."]]></Url>
                          </item>";
        }
        $newsTpl .="
                    </Articles>
                    </xml>";
        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $count);
        echo $resultStr;
    }

    /**
     * curl提交http
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
     * curl提交https
     * @param $url
     * @param string $type
     * @param string $data
     * @return mixed
     * @author zhangjian
     */
    public function httpscurl($url,$type='get',$data='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
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
     * 获取带参数二维码
     * @param $url
     * @param string $type
     * @param string $data
     * @return mixed
     * @author zhangjian
     */
    public function downqrcode($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1 );
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
        Yii::$app->session['tokentime'] = time()+7100;
    }

    /**
     * @author zhangjian
     * 判断token是否超过了两小时
     */
    public function wxtokentime()
    {
        if(!Yii::$app->session['token'] || Yii::$app->session['tokentime'] < time()){
            $this->Wxtoken();
        }
    }

    /**
     * 请求微信生成自定义菜单
     * @author zhangjian
     */
    public function actionMenu()
    {
        $this->wxtokentime();
        $url = Yii::$app->params['wxmenupath'].Yii::$app->session['token'];

        $arr = Wxmenu::find()->where(['pid'=>0])->orderBy('sort')->asArray()->all();
        $jsonx = array();
        foreach ($arr as $v){
            if(empty($v['type'])){
                $data = Wxmenu::find()->where(['pid'=>$v['id']])->asArray()->all();
                $xarr = array();
                foreach ($data as $item) {
                    if($item['type'] == 'click'){
                        $xarr[] = array('type'=>$item['type'],'name'=>urlencode($item['name']),'key'=>urlencode($item['keyword']));
                    }else{
                        $xarr[] = array('type'=>$item['type'],'name'=>urlencode($item['name']),'url'=>$item['url']);
                    }
                }if(count($xarr) > 1){
                    $warr = array('name'=>urlencode($v['name']),'sub_button'=>$xarr);
                    $jsonx[] = $warr;
                }
            }elseif($v['type'] == 'click'){
                $jsonx[] = array('type'=>$v['type'],'name'=>urlencode($v['name']),'key'=>urlencode($v['keyword']));
            }elseif($v['type'] == 'view'){
                $jsonx[] = array('type'=>$v['type'],'name'=>urlencode($v['name']),'url'=>$v['url']);
            }
        }
        $jsondata = urldecode(json_encode(array('button'=>$jsonx)));
        $ad = $this->httpscurl($url,'post',$jsondata);
        Yii::$app->session->setFlash('cremenu',1);
        return $this->redirect('index.php?r=/weixin/wxmenu/index');
    }

    /**
     * @author zhangjian
     * 获取创建二维码ticket
     */
    public function ticket($id)
    {
        $this->wxtokentime();
        $url = Yii::$app->params['ticketpath'].Yii::$app->session['token'];
        $data = ['action_name'=>'QR_LIMIT_SCENE','action_info'=>['scene'=>['scene_id'=>$id]]];
        $dajson =  json_encode($data);
        $result = $this->httpcurl($url,'post',$dajson);
        return json_decode($result)->ticket;
    }

    /**
     * @author zhangjian
     * 生成带自己参数的二维码
     */
    public function qrcode($id)
    {
        $url = Yii::$app->params['qrcodepath'].urlencode($this->ticket($id));
        $qrcode = $this->downqrcode($url);
        return Image::getQrcode('wechatqrcode',$qrcode);
    }

    /**
     * @author zhangjian
     * 生成带父参数二维码
     */
    public function fqrcode($ticket)
    {
        $url = Yii::$app->params['qrcodepath'].urlencode($ticket);
        $qrcode = $this->downqrcode($url);
        return Image::getQrcode('wechatqrcode',$qrcode);
    }

    /**
     * @param $openid
     * @author zhangjian
     * 用户关注微信公众号获取基本信息
     */
    public function getuserinfo($postObj)
    {
        $this->submsg($postObj);
        if(!User::findOne(['openid' => $postObj->FromUserName])){
            $this->wxtokentime();
            $url = Yii::$app->params['userinfopath'].Yii::$app->session['token'].'&openid='.$postObj->FromUserName.'&lang=zh_CN';
            $userinfo = $this->httpcurl($url);
            $userinfo = json_decode($userinfo,true);
            $Usermodel = new User();
            $Usermodel->openid = $postObj->FromUserName;
            if($Usermodel->save()){
                $Personmodel = new Person();
                $Personmodel->uid = $Usermodel->id;
                $Personmodel->sex = $userinfo['sex'];
                $Personmodel->save();
                $code_id = $this->qrcode($Usermodel->id);
                $Usermodel->code_id = $code_id;
                $Usermodel->save();
            }
        }
    }

    /**
     * @param $openid
     * @param $ticket
     * @author zhangjian
     * 用户扫码关注获取基本信息
     */
    public function qrgetuserinfo($postObj)
    {
        $this->submsg($postObj);
        if(!User::findOne(['openid' => $postObj->FromUserName])) {

            //通过那个id的二维码进来的父级id
            $fid = substr($postObj->EventKey, 8);
            //父级id的ticket
            $ticket = $postObj->Ticket;

            $this->wxtokentime();
            $url = Yii::$app->params['userinfopath'] . Yii::$app->session['token'] . '&openid=' . $postObj->FromUserName . '&lang=zh_CN';
            $userinfo = $this->httpcurl($url);
            $userinfo = json_decode($userinfo, true);
            $Usermodel = new User();
            $Usermodel->openid = $postObj->FromUserName;
            if ($Usermodel->save()) {
                $Personmodel = new Person();
                $Personmodel->uid = $Usermodel->id;
                $Personmodel->sex = $userinfo['sex'];
                $Personmodel->save();
                $code_id = $this->qrcode($Usermodel->id);
                $Usermodel->code_id = $code_id;
                $Usermodel->save();
            }
        }
    }
}