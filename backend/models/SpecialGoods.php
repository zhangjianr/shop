<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%special_goods}}".
 *
 * @property integer $id
 * @property integer $gid
 * @property integer $sid
 */
class SpecialGoods extends \common\core\backend\BackendActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%special_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'sid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'sid' => 'Sid',
        ];
    }

//    public function getGoods()
//    {
//        return $this->hasMany(Goods::className(), ['id' => 'gid']);
//    }
//    public function getSpecial()
//    {
//        return $this->hasMany(Special::className(), ['id' => 'sid']);
//    }
}
