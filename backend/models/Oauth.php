<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%oauth}}".
 *
 * @property integer $id
 * @property string $oauth_id
 * @property integer $uid
 * @property integer $type
 * @property integer $created_at
 */
class Oauth extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%oauth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'created_at'], 'integer'],
            [['oauth_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oauth_id' => 'Oauth ID',
            'uid' => 'Uid',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
