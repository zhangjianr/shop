<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wxmenu}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $kid
 * @property integer $status
 * @property integer $sort
 * @property string $url
 * @property integer $superior
 */
class Wxmenu extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxmenu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort','pid'], 'integer'],
            [['name', 'type'], 'string', 'max' => 45],
            [['url','keyword'], 'string', 'max' => 100],
            [['sort'], 'default', 'value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单标题',
            'type' => '类型',
            'keyword' => '关键词',
            'status' => 'Status',
            'sort' => '排序',
            'url' => '跳转链接',
            'pid' => '一级菜单',
        ];
    }
}
