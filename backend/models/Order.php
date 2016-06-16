<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
 * @property integer $goods_id
 */
class Order extends \common\core\backend\BackendActiveRecord
{

    //0-处理中 1-处理成功 2-处理失败
    const STATUS_WAIT = 0;
    const STATUS_OK = 1;
    const STATUS_FAIL = 2;

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
            [['uid', 'order_status', 'pay_status', 'type', 'created_at', 'updated_at', 'order_service', 'over_at', 'start_at', 'goods_id'], 'integer'],
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
            'order_sn' => '订单号',
            'uid' => '客户',
            'order_status' => '订单状态',
            'order_fail' => '订单失败原因',
            'pay_status' => '支付状态',
            'type' => '类型',
            'pay_note' => '支付备注',
            'inv_type' => '发票类型',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'order_service' => '订单服务',
            'over_at' => '完成时间',
            'start_at' => '开始时间',
            'goods_id' => '商品名',
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * 券号表
     * @author wuqi
     */
    public function getCnumber()
    {
       return $this->hasOne(CouponsNumber::className(), ['oid' => 'id']);
    }

}
