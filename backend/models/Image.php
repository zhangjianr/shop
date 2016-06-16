<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $type_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $logo
 */
class Image extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'type_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['logo'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'type_id' => 'Type ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'logo' => 'Logo',
        ];
    }

    /** 根据id 获取图片完整路径
     * @param $id
     * @author wuqi
     */
    public static function getImage($id)
    {
        if(!$id){
            return '';
        }
        $imageDomain = Yii::getAlias("@imageDomain");
        $model = static::findOne($id);
        if (isset($model->name)) {
            if (substr($model->name, 0, 4) == 'http') {
                return $model->name;
            } else {
                return $imageDomain . $model->name;
            }
        } else {
            return null;
        }
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

}

