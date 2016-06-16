<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%coupons_number}}".
 *
 * @property integer $id
 * @property string $number
 * @property integer $cid
 * @property integer $oid
 * @property integer $uid
 * @property integer $use_time
 * @property integer $status
 */
class CouponsNumber extends \common\core\backend\BackendActiveRecord
{
    const STATUS_USE = 10;
    const STATUS_UNUSE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupons_number}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'oid', 'uid', 'use_time', 'status'], 'integer'],
            [['number'], 'string', 'max' => 64],
            [['number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'cid' => 'Cid',
            'oid' => 'Oid',
            'uid' => 'Uid',
            'use_time' => 'Use Time',
            'status' => 'Status',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'oid']);
    }


    public function getCoupons()
    {
        return $this->hasOne(Coupons::className(), ['id' => 'cid']);
    }
}
