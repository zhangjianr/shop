<?php

namespace backend\models;

use Yii;
use common\core\backend\BackendActiveRecord;

/**
 * This is the model class for table "{{%keyword}}".
 *
 * @property integer $id
 * @property string $keyword
 */
class Keyword extends BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%keyword}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword','status'], 'required'],
            [['keyword'], 'unique'],
            [['keyword'], 'string', 'max' => 50],
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
        ];
    }
}
