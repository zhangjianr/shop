<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/6/1
 * Time: 下午11:03
 * @author wuqi
 */
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{

    /** 图片上传   图片验证在对应的模型验证
     * @param string $dir 创建指定目录
     * @return bool
     */
    public function upload($model, $field, $dirname)
    {
        $file = UploadedFile::getInstance($model, $field);
        if ($file) {
            $uploadsPath = Yii::getAlias('@uploads');
            $path = '/' . $dirname . '/' . date('Ymd') . '/';
            $absolutePath = $uploadsPath . $path;
            is_dir($absolutePath) || mkdir($absolutePath, 0777, true);
            $filename = time() . rand(1000, 9999);
            $fileAllName = $absolutePath . $filename . '.' . $file->extension;
            $file->saveAs($fileAllName);
            //缩略图生成
//            Image::frame($fileAllName, 0, '666', 0)
//                ->resize(new Box(100, 50), ImageInterface::FILTER_LANCZOS)
//                ->save($absolutePath . 'thumb_' . $filename . '.' . $this->file->extension, ['quality' => 50]);

            $imageModel = new Image();
            $imageModel->name = $path . $filename . '.' . $file->extension;
            $res = $imageModel->save();
            if ($res) {
                $model->$field = $imageModel->id;
            }
        } else {
            unset($model->$field);
        }
    }


    //生成缩略图
    public function thumbImage($file)
    {

    }


}