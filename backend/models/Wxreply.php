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
            [['kid', 'title', 'description', 'picurl', 'url'], 'required'],
            [['kid', 'sort'], 'integer','max'=>99],
//            [['kid'], 'replynum'],
            [['title'], 'string', 'max' => 100],
            [['url'],'url'],
            [['description', 'picurl', 'url'], 'string', 'max' => 255],
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
            'kid' => '关键词',
            'title' => '标题',
            'description' => '简介',
            'picurl' => '图片',
            'url' => '连接地址',
            'sort' => '排序',
        ];
    }
}