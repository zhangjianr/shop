<?php

namespace supplier\models;

use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $address
 * @property string $profession
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $integral
 * @property integer $uid
 */
class Person extends \common\core\supplier\SupplierActiveRecord
{

    public $ddid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'age', 'created_at', 'updated_at', 'integral', 'uid'], 'integer'],
            [['name', 'profession'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'sex' => '性别',
            'age' => '年龄',
            'address' => '地址',
            'profession' => '职业',
            'created_at' => '注册时间',
            'updated_at' => '修改时间',
            'integral' => '积分',
            'uid' => 'Uid',
        ];
    }

    public function getOrdercom()
    {
        return $this->hasMany(OrderCompany::className(), ['order_id' => 'id'])
            ->viaTable('shop_order', ['uid' => 'uid']);
    }

    /**
     * @param $order_id
     * @return string
     * @author zhangjian
     * 获取用户数据
     */
    public static function getUsername($order_id)
    {
        $data = Order::findOne($order_id);
        $arr = static::findOne(['uid'=>$data->uid]);
        if($arr){
            return $arr;
        }else{
            return '没有';
        }
    }
}
