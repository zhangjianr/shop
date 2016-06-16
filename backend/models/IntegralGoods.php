<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%integral_goods}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $image_id
 * @property integer $integral
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class IntegralGoods extends \common\core\backend\BackendActiveRecord
{

    const DELETE_TRUE = 1;
    const DELETE_FALSE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%integral_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['integral', 'created_at', 'updated_at', 'status', 'is_del'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名字',
            'number' => '数量',
            'image_id' => '商品图片',
            'integral' => '兑换积分',
            'content' => '商品说明',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'shelves' => '状态',
            'shelves_at' => '上架时间',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getIorder()
    {
        return $this->hasMany(IntegralOrder::className(), ['gid' => 'id']);
    }
}
