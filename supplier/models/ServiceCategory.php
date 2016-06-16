<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;

class ServiceCategory extends SupplierActiveRecord
{
    public static function tableName()
    {
        return '{{%service_category}}';
    }

    /**
     * @param $order_id
     * @return mixed|string
     * @author zhangjian
     * 获取服务分类名
     */
    public static function getCatename($order_id)
    {
        $data = Order::findOne($order_id);
        $arr = static::findOne($data->type_id);
        if($arr){
            return $arr->name;
        }else{
            return '没有';
        }
    }
}