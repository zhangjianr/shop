<?php
namespace common\core\backend;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class BackendController extends Controller
{

    /**
     * @param \yii\base\Action $actoin
     * @return bool
     * @author wuqi
     * @throws \yii\web\BadRequestHttpException
     */
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





    public static function truncate_utf8_string($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }
    
}