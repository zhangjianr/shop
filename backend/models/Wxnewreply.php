<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wxnewreply}}".
 *
 * @property integer $id
 * @property integer $kid
 * @property string $content
 */
class Wxnewreply extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxnewreply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword', 'content'], 'required'],
            [['keyword'], 'string'],
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
            'keyword' => '关键词',
            'content' => '回复内容',
        ];
    }
}
