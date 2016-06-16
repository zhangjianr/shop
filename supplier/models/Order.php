<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $order_sn
 * @property integer $uid
 * @property integer $order_status
 * @property string $order_fail
 * @property integer $pay_status
 * @property integer $type
 * @property string $pay_note
 * @property string $inv_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $order_service
 * @property integer $over_at
 * @property integer $start_at
 * @property integer $brand_id
 */
class Order extends SupplierActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'order_status', 'pay_status', 'type', 'created_at', 'updated_at', 'order_service', 'over_at', 'start_at', 'brand_id'], 'integer'],
            [['order_sn', 'inv_type'], 'string', 'max' => 45],
            [['order_fail', 'pay_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_sn' => 'Order Sn',
            'uid' => 'Uid',
            'order_status' => 'Order Status',
            'order_fail' => 'Order Fail',
            'pay_status' => 'Pay Status',
            'type' => 'Type',
            'pay_note' => 'Pay Note',
            'inv_type' => 'Inv Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'order_service' => 'Order Service',
            'over_at' => 'Over At',
            'start_at' => 'Start At',
            'brand_id' => 'Brand ID',
        ];
    }
    
}
