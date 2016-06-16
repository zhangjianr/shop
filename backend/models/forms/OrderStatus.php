<?php
namespace backend\models\forms;



use backend\models\Order;
use common\core\backend\BackendModel;

class OrderStatus extends BackendModel
{
    public $sid;
    public $order_status;
    public $order_fail;


    public function rules()
    {
        return [
            [['order_status'], 'required'],
            [['sid', 'order_status'], 'integer'],
            ['order_fail', 'string', 'max' =>'255'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'order_status' => '订单状态',
            'order_fail' => '订单失败原因'
        ];
    }

    public function setStatus()
    {
        if (!$this->validate()) {
            return null;
        }

        $model = Order::findOne($this->sid);
        $model->order_status = $this->order_status;
        $model->order_fail = $this->order_fail ? $this->order_fail : '';
        return $model->save() ? $model : null;

    }


}