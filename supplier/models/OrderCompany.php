<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;

/**
 * This is the model class for table "{{%order_company}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $company_id
 * @property integer $create_at
 * @property integer $over_time
 * @property integer $status
 */
class OrderCompany extends SupplierActiveRecord
{

    public $order_sn;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'company_id', 'create_at', 'over_time', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单id',
            'company_id' => '商家id',
            'create_at' => '开始时间',
            'over_time' => '结束时间',
            'status' => '状态',
            'order_sn' => '订单号',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id'=>'order_id']);
    }

}
