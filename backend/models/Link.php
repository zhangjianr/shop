<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%link}}".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $title
 * @property string $url
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Link extends \common\core\backend\BackendActiveRecord
{
    const DELETE_TRUE = 10;
    const DELETE_FALSE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['sort', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['url'], 'string', 'max' => 255],
            ['sort', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => '图片',
            'title' => '标题',
            'url' => '链接',
            'sort' => '排序',
            'created_at' => '添加时间',
            'updated_at' => 'Updated At',
            'status' => '状态',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
