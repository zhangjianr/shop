<?php

namespace frontend\models;

use Yii;
use common\core\frontend\FrontendActiveRecord;

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
class Person extends FrontendActiveRecord
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
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'sex' => '性别',
            'age' => '年龄',
            'address' => '地址',
            'profession' => '职业',
            'created_at' => '完善时间',
            'updated_at' => '修改时间',
            'integral' => '积分',
            'uid' => 'Uid',
        ];
    }
}
