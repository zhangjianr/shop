<?php

namespace backend\models;

use Yii;
use common\models\User;
use common\core\backend\BackendActiveRecord;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $address
 * @property string $profession
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $integral
 * @property integer $uid
 */
class Person extends BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'age', 'created_at', 'updated_at', 'integral', 'uid'], 'integer'],
            [['name', 'profession'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '昵称',
            'sex' => 'Sex',
            'age' => 'Age',
            'address' => 'Address',
            'profession' => 'Profession',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'integral' => '积分',
            'uid' => 'Uid',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    public function getFeedback()
    {
        return $this->hasMany(Feedback::className(), ['uid' => 'uid']);
    }

    public function getIntegral()
    {
        return $this->hasMany(Integral::className(), ['uid' => 'uid']);
    }

    public function getIorder()
    {
        return $this->hasMany(IntegralOrder::className(), ['uid' => 'uid']);
    }
}
