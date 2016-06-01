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
            [['kid', 'content'], 'required'],
            [['kid'], 'integer'],
            [['kid'], 'unique','message'=>'此关键词已被占用'],
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
            'kid' => '关键词',
            'content' => '回复内容',
        ];
    }
}
