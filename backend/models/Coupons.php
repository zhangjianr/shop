<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\core\backend\BackendActiveRecord;
/**
 * This is the model class for table "{{%coupons}}".
 *
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $starttime
 * @property integer $endtime
 * @property integer $is_del
 */
class Coupons extends BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupons}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['number', 'created_at', 'is_del'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            ['name', 'unique'],
            [['starttime', 'endtime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '个数',
            'name' => '名称',
            'description' => '详细描述',
            'created_at' => '发布时间',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'is_del' => 'Is Del',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BackendActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
            ]
        ];
    }

    /**
     * 券号表
     * @author wuqi
     */
    public function getCnumber()
    {
        return $this->hasMany(CouponsNumber::className(), ['cid' => 'id']);
    }

}
