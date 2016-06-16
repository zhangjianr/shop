<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%integral_order}}".
 *
 * @property integer $id
 * @property integer $gid
 * @property integer $uid
 * @property integer $type
 * @property string $express_company
 * @property string $express_num
 * @property integer $is_del
 * @property integer $integral
 * @property string $address
 * @property string $contact
 * @property string $mobile
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $ship_at
 * @property string $order_sn
 */
class IntegralOrder extends \common\core\backend\BackendActiveRecord
{
    const TYPE_TRUE = 10;
    const TYPE_FALSE = 0;

    const DELETE_TRUE = 10;
    const DELETE_FALSE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%integral_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'uid', 'type', 'is_del', 'integral', 'created_at', 'updated_at', 'ship_at'], 'integer'],
            [['express_company', 'express_num'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 255],
            [['contact'], 'string', 'max' => 45],
            [['mobile'], 'string', 'max' => 11],
            [['order_sn'], 'string', 'max' => 50],
            [['order_sn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'uid' => 'Uid',
            'type' => 'Type',
            'express_company' => '快递公司',
            'express_num' => '快递单号',
            'is_del' => '是否删除',
            'integral' => '积分',
            'address' => '地址',
            'contact' => '联系人',
            'mobile' => '手机号',
            'created_at' => '兑换时间',
            'updated_at' => 'Updated At',
            'ship_at' => '发货时间',
            'order_sn' => '订单号',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['uid' => 'uid']);
    }

    public function getIgoods()
    {
        return $this->hasOne(IntegralGoods::className(), ['id' => 'gid']);
    }

}
