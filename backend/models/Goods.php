<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $service_name
 * @property integer $image_id
 * @property integer $service_cid
 * @property integer $type_id
 * @property integer $attri_id
 * @property string $detail
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_del
 */
class Goods extends \common\core\backend\BackendActiveRecord
{
    const STATUS_UP_SHELVES = 10;
    const STATUS_DOWN_SHELVES = 0;
    const DELETE_TRUE = 1;
    const DELETE_FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    public function getSpecial()
    {
        return $this->hasMany(Special::className(), ['id' => 'sid'])
            ->viaTable('{{%special_goods}}', ['gid' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_cid', 'type_id'], 'required'],
            [[ 'service_cid', 'attri_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['detail'], 'string'],
            [['service_name'], 'string', 'max' => 128],
            [['image_id'], 'file', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 1024 * 1024 * 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_name' => '商品名',
            'image_id' => '图片',
            'service_cid' => '所属分类',
            'type_id' => '服务类型',
            'attri_id' => '属性',
            'detail' => '商品详情',
            'created_at' => '上架时间',
            'updated_at' => '更新时间',
            'is_del' => 'Is Del',
            'status' => '状态',
            'price' => '价格',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
