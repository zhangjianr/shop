<?php

use yii\helpers\Html;
use yii\grid\GridView;
use supplier\models\Order;
use supplier\models\Person;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '业务列表';
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

                        ['label'=>'客户','attribute'=>'order.uid','value'=>function($data){
                            $arr = Person::findBySql('select name from shop_person where uid = '.$data->order['uid'])->asArray()->one();
                            return $arr['name'];
                        }],
                        'order_id',
                        [   'label' => '订单号',
                            'attribute'=>'order_id',
                            'value'=> function($data){
                                $arr = Order::findBySql('select order_sn from shop_order where id = '.$data->order_id)->asArray()->one();
                                return $arr['order_sn'];
                            }],
                        //'company_id',
                        'create_at:datetime',
                        'over_time:datetime',
                        // 'status',

                        ['class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view}',
                            'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a("评论", ['/reply/create','order_id'=>$model->order_id,'uid'=>$model->order['uid']  ], ['class' => 'btn btn-primary']);
                            },
                        ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>