<?php

namespace supplier\models;

use Yii;
use common\core\supplier\SupplierActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%custom_order}}".
 *
 * @property integer $id
 * @property string $contact
 * @property string $tel
 * @property integer $cate_id
 * @property string $company
 * @property string $content
 * @property string $order_sn
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $over_at
 */
class CustomOrder extends SupplierActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%custom_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id', 'created_at', 'updated_at', 'over_at'], 'integer'],
            [['content'], 'string'],
            [['contact', 'tel', 'order_sn'], 'string', 'max' => 45],
            [['company'], 'string', 'max' => 255],
            [['over_at status'], 'default', 'value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact' => '联系人',
            'tel' => '联系电话',
            'cate_id' => '服务分类',
            'company_name' => '公司名称',
            'content' => '需求详情',
            'order_sn' => '订单号',
            'created_at' => '订单时间',
            'updated_at' => 'updated_at',
            'status' => '状态',
            'over_at' => '完成时间',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
