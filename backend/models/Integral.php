<?php

namespace backend\models;


use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%integral}}".
 *
 * @property integer $id
 * @property integer $integral
 * @property string $description
 * @property integer $created_at
 * @property integer $uid
 * @property integer $number
 */
class Integral extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%integral}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['integral', 'created_at', 'uid', 'number'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'integral' => '积分',
            'description' => '备注',
            'created_at' => '操作时间',
            'uid' => 'Uid',
            'number' => '数量',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['uid' => 'uid']);
    }
}
