<?php

namespace supplier\models;

use common\core\supplier\SupplierActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%reply}}".
 *
 * @property integer $id
 * @property integer $sid
 * @property integer $did
 * @property integer $order_id
 * @property string $content
 * @property integer $type
 * @property integer $created_at
 * @property integer $start
 */
class Reply extends \common\core\supplier\SupplierActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'did', 'order_id', 'type', 'created_at', 'start'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => '评论用户',
            'did' => 'Did',
            'order_id' => '订单id',
            'content' => '评论内容',
            'type' => 'Type',
            'created_at' => '评论时间',
            'start' => '星级',
            'order_sn' => '订单号',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    SupplierActiveRecord::EVENT_BEFORE_INSERT => 'created_at'
                ]
            ]
        ];
    }
    
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id'=>'order_id']);
    }
}
