<?php

namespace backend\models;

use Yii;

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
class Reply extends \common\core\backend\BackendActiveRecord
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
            [['id'], 'required'],
            [['id', 'sid', 'did', 'order_id', 'type', 'created_at', 'start'], 'integer'],
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
            'sid' => '评论人',
            'did' => 'Did',
            'order_id' => '订单ID',
            'content' => '内容',
            'type' => '类型',
            'created_at' => '创建时间',
            'start' => 'Start',
        ];
    }
}
