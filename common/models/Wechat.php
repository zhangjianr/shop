<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Wechat extends ActiveRecord
{
    
    
    /**
     * curl提交https
     * @param $url
     * @param string $type
     * @param string $data
     * @return mixed
     * @author zhangjian
     */
    public function getHttpscurl($url,$type='get',$data='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }

    /**
     * curl提交http
     * @param $url
     * @param string $type
     * @param string $data
     * @return mixed
     * @author zhangjian
     */
    public function getHttpcurl($url,$type='get',$data='')
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
        $result = $this->getHttpcurl($url);
        $token = json_decode($result,true);
        Yii::$app->session['token'] = $token['access_token'];
        Yii::$app->session['tokentime'] = time()+7100;
    }

    /**
     * @author zhangjian
     * 判断token是否超过了两小时
     */
    public function getWxtokentime()
    {
        if(!Yii::$app->session['token'] || Yii::$app->session['tokentime'] < time()){
            $this->Wxtoken();
        }
    }
}