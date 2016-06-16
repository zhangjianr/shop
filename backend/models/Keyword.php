<?php

namespace backend\models;

use Yii;
use common\core\backend\BackendActiveRecord;
use yii\behaviors\TimestampBehavior;

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
            [['keyword'], 'required'],
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

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
