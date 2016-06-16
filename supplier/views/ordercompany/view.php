<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use supplier\models\Order;
use supplier\models\ServiceType;
use supplier\models\ServiceCategory;
use supplier\models\Attribute;
use supplier\models\Person;

/* @var $this yii\web\View */
/* @var $model supplier\models\OrderCompany */

$this->title = '订单详情';
$this->params['breadcrumbs'][] = ['label' => 'Order Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => '订单号',
                            'attribute' => 'order_id',
                            'value' => Order::findOne($model->order_id)->order_sn,
                        ],
                        [
                            'label' => '商品ID',
                            'attribute' => 'order_id',
                            'format' => 'raw',
                            'value' => Order::findOne($model->order_id)->id.Html::a("查看", ['goods/view','id'=>Order::findOne($model->order_id)->id], ['class' => 'col-sm-offset-1']),
                        ],
                        [
                            'label' => '所属服务分类',
                            'attribute' => 'order_id',
                            'value' =>ServiceCategory::getCatename($model->order_id),
                        ],
                        [
                            'label' => '所属单项服务分类',
                            'attribute' => 'order_id',
                            'value' => ServiceType::getName($model->order_id),
                        ],
                        [
                            'label' => '所属属性',
                            'attribute' => 'order_id',
                            'value' => Attribute::getAttrname($model->order_id),
                        ],
                        [
                            'label' => '关联的客户',
                            'attribute' => 'contact',
                            'format' => 'raw',
                            'value' => Person::getUsername($model->order_id)->name . Html::a("查看", ['person/cview','uid'=>Person::getUsername($model->order_id)->uid], ['class' => 'col-sm-offset-1']),
                        ],
                    ],
                    'template' => '<tr><th width="150px;">{label}</th><td>{value}</td></tr>',
                ]) ?>

            </div>
        </div>
    </div>
</div>
