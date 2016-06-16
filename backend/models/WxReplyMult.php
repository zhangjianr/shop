<?php

namespace backend\models;

use Yii;
use common\core\backend\BackendActiveRecord;

/**
 * This is the model class for table "{{%wx_reply_mult}}".
 *
 * @property integer $id
 * @property string $keyword
 * @property integer $keyword_type
 * @property string $mult_ids
 */
class WxReplyMult extends BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_reply_mult}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'],'required'],
            [['keyword_type'], 'integer'],
            [['keyword'], 'string', 'max' => 64],
            [['mult_ids'], 'string', 'max' => 255],
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
            'keyword_type' => '类型',
            'mult_ids' => '图文',
        ];
    }
}
