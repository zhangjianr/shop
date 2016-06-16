<?php
namespace common\core\supplier;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class SupplierController extends Controller{

    public function beforeAction($actoin)
    {
        $contro = Yii::$app->controller;
        //$module = $contro->module->id;
        $action = $contro->action->id;
        $controller = $contro->id;
        $route = "/$controller/$action";
//        if (Yii::$app->user->id == 1 || $this->ignoreAction($route)) {
//            return parent::beforeAction($actoin);
//        } else if (!Yii::$app->user->can($route) && Yii::$app->user->id != 1) {
//            Yii::$app->session->setFlash('message', "您还没有当前操作权限");
//            $this->goHome();
//        } else {
        if (Yii::$app->user->isGuest) {
             $this->redirect(Url::toRoute('/site/login'));
        } else {
            return parent::beforeAction($actoin);
        }
        //       }
    }
}