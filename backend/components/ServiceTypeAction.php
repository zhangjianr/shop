<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/6/5
 * Time: 下午4:12
 * @author wuqi
 */
namespace backend\components;


use yii\base\Action;
use Yii;
use backend\models\ServiceType;
use yii\helpers\ArrayHelper;

class ServiceTypeAction extends Action
{

    /** 获取类型列表
     * @author wuqi
     */
    public function run()
    {
        $post = Yii::$app->request->post();
        $res = ServiceType::findAll(['status' => ServiceType::STATUS_ACTIVE, 'service_cid' => $post['id']]);

        echo "<option>请选择</option>";
        if (count(ArrayHelper::toArray($res)) > 0) {
            foreach ($res as $v) {
                echo "<option value = '" . $v->id . "'>" . $v->name . " </option>";
            }
        }
    }


}