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
            sort($arr);
            $arrstr = implode( $arr );
            if($arrstr == $signature){
                echo $echoStr;
                exit;
            }
        }
    }