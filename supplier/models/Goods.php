<?php

namespace supplier\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property string $service_name
 * @property integer $image_id
 * @property integer $service_cid
 * @property integer $type_id
 * @property integer $attri_id
 * @property string $detail
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_del
 * @property integer $status
 * @property string $price
 */
class Goods extends \common\core\supplier\SupplierActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'service_cid', 'type_id', 'attri_id', 'created_at', 'updated_at', 'is_del', 'status'], 'integer'],
            [['detail'], 'string'],
            [['price'], 'number'],
            [['service_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_name' => '服务名',
            'image_id' => '商品图片',
            'service_cid' => '所属分类',
            'type_id' => '服务类型',
            'attri_id' => '所属属性',
            'detail' => '商品详情',
            'created_at' => '上架时间',
            'updated_at' => '更新时间',
            'is_del' => 'Is Del',
            'status' => 'Status',
            'price' => '价格',
        ];
    }
}
