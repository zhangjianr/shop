<?php

namespace supplier\models;

use common\core\supplier\SupplierActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $uid
 * @property integer $created_at
 */
class Feedback extends \common\core\supplier\SupplierActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['uid', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '反馈内容',
            'uid' => 'Uid',
            'created_at' => '留言时间',
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
}
