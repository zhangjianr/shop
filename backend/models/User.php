<?php
namespace backend\models;

use Yii;
use common\core\backend\BackendActiveRecord;

class User extends BackendActiveRecord{

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['openid'], 'unique'],
        ];
    }
}