<?php

use yii\helpers\Html;
use yii\grid\GridView;
use supplier\models\Order;
use supplier\models\ServiceType;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [

                        'id',
                        [
                            'label' => '订单号',
                            'attribute' => 'order_id',
                            'value' => function($model){
                                $data = Order::findOne($model->order_id);return $data->order_sn;
                            }
                        ],
                        [
                            'label' => '服务名',
                            'attribute' => 'order_id',
                            'value' => function($model){
                                return ServiceType::getName($model->order_id);
                            }
                        ],
                        [
                            'label' => '价格',
                            'attribute' => 'order_id',
                            'value' => function($model){
                                $data = Order::findOne($model->order_id);return $data->price;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function($model){
                                return $model->status == 0? '未处理' : '以处理' ;
                            }
                        ],
                        [
                            'attribute' => 'create_at',
                            'value' => function($model){
                                return date('Y-m-d H:i:s',$model->create_at);
                            }
                        ],
//                        'order_id',
//                        'company_id',
//                        'over_time:datetime',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a("详情", $url);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>