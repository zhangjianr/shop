<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\core\backend\BackendActiveRecord;
/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $type_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Image extends BackendActiveRecord
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
            [['type', 'type_id', 'created_at', 'updated_at'], 'integer'],
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
            'name' => 'Name',
            'type' => 'Type',
            'type_id' => 'Type ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getImage($id)
    {
        if(!$id){
            return '';
        }
        $imageDomain = Yii::getAlias("@imageDomain");
        $model = static::findOne($id);
        if ($model->name) {
            if (substr($model->name, 0, 4) == 'http') {
                return $model->name;
            } else {
                return $imageDomain . $model->name;
            }
        } else {
            return '';
        }
    }
    
    /**
     * @author zhangjian
     * 生成带参数二维码
     */
    public function getQrcode($file,$qrcode)
    {
        $uploadsPath = Yii::getAlias('@uploads');
        $path = '/'.$file .'/'. date('Ymd') . '/';
        $absolutePath = $uploadsPath . $path;
        is_dir($absolutePath) || mkdir($absolutePath, 0777, true);
        $filename = time() . rand(1000, 9999).'.jpg';
        $fileAllName = $absolutePath . $filename;
        file_put_contents($fileAllName, $qrcode);
        $imageModel = new Image();
        $imageModel->name = $path.$filename;
        $imageModel->save();
        return $imageModel->id;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
}
