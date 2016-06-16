<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%service_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $service_cid
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property integer $status
 */
class ServiceType extends \common\core\backend\BackendActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_cid', 'name'], 'required'],
            [['service_cid', 'created_at', 'updated_at', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 64],
            ['name', 'customunique'],
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
            'name' => '单项服务名称',
            'service_cid' => '所属服务分类',
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


    public function getServiceCategory()
    {
        return $this->hasOne(ServiceCategory::className(), ['id' => 'service_cid']);
    }
}
