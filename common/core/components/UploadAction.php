<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 16-5-27
 * Time: 下午7:19
 */
namespace common\core\components;

use Yii;
use yii\base\Action;

class UploadAction extends Action
{

    public function run()
    {

        $fileName = 'file';
        $uploadPath = Yii::$app->params['uploadPath'].date("Y-m-d");

        if (!file_exists($uploadPath)){
            mkdir($uploadPath);
        }

        if (isset($_FILES[$fileName])) {

            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            $suffix = substr($file->name,strrpos($file->name,'.'));
            $fname = '/'.mt_rand().time().$suffix;

            if ($file->saveAs( $uploadPath.$fname)) {
                echo date("Y-m-d").$fname;
            }
        }

        return false;
    }
    
}