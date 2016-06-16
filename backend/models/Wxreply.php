<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wxreply}}".
 *
 * @property integer $id
 * @property integer $kid
 * @property string $title
 * @property string $description
 * @property string $picurl
 * @property string $url
 * @property integer $sort
 */
class Wxreply extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxreply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword', 'title', 'description', 'image_id', 'url'], 'required'],
            [['title','keyword'], 'string', 'max' => 100],
            [['url'],'url'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * 判断图文回复不能超过七个
     * @author zhangjian
     */
//    public function replynum($attribute)
//    {
//        $num = Wxreply::find()->where(['kid' => $this->kid])->count();
//        if($num > 6){
//            $this->addError($attribute, '图文回复最多只能同时七条 已达上限');
//        }
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => '关键词',
            'title' => '标题',
            'description' => '简介',
            'image_id' => '图片',
            'url' => '连接地址',
        ];
    }

    /**
     * @author zhangjian
     * 
     */
    public function keyname($result)
    {
        $data = explode(',', $result);
        return Wxreply::find()->where(['in', 'id', $data])->all();
    }
}