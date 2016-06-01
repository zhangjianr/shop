<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/5/31
 * Time: 下午7:10
 * @author wuqi
 */
namespace backend\components;


use Yii;
use yii\base\Action;

class StatusAction extends Action
{


    public function run()
    {

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $model = $post['model'];
            $userModel = $model::findOne($post['uid']);
            $userModel->status = $post['isLock'];
            $res = $userModel->save();
            if ($res) {
//                if($post['isLock'] == 0){
//                    $description = '用户ID为：'. $post['uid'] . '的用户已经被解锁';
//                }else{
//                    $description = '用户ID为：'. $post['uid'] . '的用户已经被锁定';
//                }
                //$userModel::actionLog($description);
                // Yii::$app->session->setFlash('updateImg', '设置成功');
                $status = 1;
            } else {
                $status = 0;
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => $status, 'url' => Yii::$app->request->referrer];
        }
    }


}