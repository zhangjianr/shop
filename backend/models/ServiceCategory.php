<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%service_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property integer $status
 */
class ServiceCategory extends \common\core\backend\BackendActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['created_at', 'updated_at', 'sort', 'status'], 'integer'],
            ['name', 'customunique'],
            [['name'], 'string', 'max' => 64],
            ['sort', 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /** value unique
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
            'name' => '服务名',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    public function getServiceType()
    {
        return $this->hasMany(ServiceType::className(), ['service_cid' => 'id']);
    }

}
