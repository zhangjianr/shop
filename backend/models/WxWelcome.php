<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wx_welcome}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $kid
 */
class WxWelcome extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_welcome}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','type','kid'], 'required'],
            [['id', 'type', 'kid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'kid' => '关键词',
        ];
    }
}
