<?php
namespace backend\controllers;

use Yii;
use common\core\backend\BackendController;

    /**
     * Class WechatController
     * @package backend\controllers
     * @author zhangjian
     * 微信操作类
     */


    class WechatController extends BackendController
    {
        public function actionGeneral()
        {
            return $this->render('general');
        }
        
    }
