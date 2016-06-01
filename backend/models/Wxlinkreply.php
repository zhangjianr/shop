<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wxlinkreply}}".
 *
 * @property integer $id
 * @property integer $kid
 * @property string $link
 * @property string $content
 */
class Wxlinkreply extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxlinkreply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kid', 'link', 'content'], 'required'],
            [['kid'], 'integer'],
            [['kid'], 'unique','message'=>'此关键词已被占用'],
            [['content'], 'string'],
            [['link'], 'url'],
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
            'link' => '连接地址',
            'content' => '链接标题',
        ];
    }
}
