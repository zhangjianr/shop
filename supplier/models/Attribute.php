<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;

class Attribute extends SupplierActiveRecord
{
    public static function tableName()
    {
        return '{{%attribute}}';
    }

    /**
     * @param $order_id
     * @return mixed|string
     * @author zhangjian
     * 获取属性名
     */
    public static function getAttrname($order_id)
    {
        $data = Order::findOne($order_id);
        $arr = static::findOne(['type_id'=>$data->type_id]);
        if($arr){
            return $arr->name;
        }else{
            return '没有';
        }
    }
}