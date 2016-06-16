<?php

namespace backend\models;

use common\core\backend\BackendActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
class OrderCompany extends \common\core\backend\BackendActiveRecord
{

    public $cate_id;

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
            [['cate_id', 'company_id'], 'required'],
            [['cate_id'], 'validateExists'],
            [['order_id', 'create_at', 'over_time', 'status'], 'integer'],
        ];
    }


    public function validateExists($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $res = static::findAll(['order_id' => $this->order_id, 'company_id' => $this->company_id]);
            if(count($res) > 0) {
                $this->addError($attribute, '您已绑定过此类型.');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'company_id' => '供应商',
            'cate_id' => '服务分类',
            'create_at' => '绑定时间',
            'over_time' => 'Over Time',
            'status' => 'Status',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BackendActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                    BackendActiveRecord::EVENT_BEFORE_UPDATE => ['create_at'],
                ],
            ],
        ];
    }
}
