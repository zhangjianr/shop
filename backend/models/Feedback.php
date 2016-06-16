<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $uid
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $reply_content
 * @property integer $status
 * @property integer $type
 */
class Feedback extends \common\core\backend\BackendActiveRecord
{

    const STATUS_TRUE = 10;
    const STATUS_FALSE = 0;

    const TYPE_SUPPLIER = 0;
    const TYPE_USER = 10;

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
            [['content', 'reply_content'], 'string'],
            [['uid', 'created_at', 'updated_at', 'status', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容摘要',
            'uid' => 'uid',
            'created_at' => '提交时间',
            'updated_at' => '处理时间',
            'reply_content' => 'Reply Content',
            'status' => '状态',
            'type' => 'Type',
        ];
    }

    public function getCompanyReg()
    {
        return $this->hasOne(CompanyReg::className(), ['id' => 'uid']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['uid' => 'uid']);
    }
}
