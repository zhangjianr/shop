<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $image_id
 * @property string $url
 * @property integer $sort
 * @property integer $status
 * @property integer $is_del
 */
class Banner extends \common\core\backend\BackendActiveRecord
{
    const DELETE_TRUE = 10;
    const DELETE_FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['description'], 'string'],
           // [['image_id'], 'required'],
            [['sort', 'status', 'is_del'], 'integer'],
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
            'title' => '标题',
            'description' => '表述',
            'image_id' => '图片',
            'url' => '链接',
            'sort' => '排序',
            'status' => '状态',
            'created_at' => '添加时间',
            'is_del' => 'Is Del',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
