<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $type_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 */
class Attribute extends \common\core\backend\BackendActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type_id', 'cate_id', 'created_at', 'updated_at', 'sort', 'type'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 255],
            ['name', 'customunique'],
            ['sort', 'default', 'value' => 0],
            ['status', 'default', 'value' => 10],
        ];
    }

    /** validate name value unique
     * @param $attribute
     * @param $params
     * @author wuqi
     */
    public function customunique($attribute, $params)
    {
        $model = static::find()->where(['name' => $this->name, 'status' => self::STATUS_ACTIVE]);
        if ($this->id) {
            $model->andWhere(['<>', 'id', $this->id]);
        }
        if ($model->one()) {
            $this->addError($attribute, $this->name . '已经被占用了。');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '属性名',
            'value' => '属性值',
            'cate_id' => '分类名称',
            'type_id' => '类型名称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'type' => '类型',
            'sort' => '排序',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
