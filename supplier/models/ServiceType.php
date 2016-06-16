<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;

class ServiceType extends SupplierActiveRecord
{
    public static function tableName()
    {
        return '{{%service_type}}';
    }

    /**
     * @param $id
     * @return mixed|string
     * @author zhangjian
     * 获取单项服务分类名
     */
    public static function getName($id)
    {
        $data = Order::findOne($id);
        $arr = static::findOne($data->type_id);
        if($arr){
            return $arr->name;
        }else{
            return '木有';
        }
    }
}