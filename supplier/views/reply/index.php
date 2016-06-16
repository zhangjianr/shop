<?php

use yii\helpers\Html;
use yii\grid\GridView;
use supplier\models\Person;
use supplier\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\ReplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
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

            ['label'=>'用户','attribute'=>'sid','value'=>function($data){
                $arr = Person::findBySql('select name from shop_person where uid = '.$data->sid)->asArray()->one();
                return $arr['name'];
            }],

            [   'label' => '订单号',
                'attribute'=>'order_id',
                'value'=> function($data){
                    $arr = Order::findBySql('select order_sn from shop_order where id = '.$data->order_id)->asArray()->one();
                    return $arr['order_sn'];
                }],
            'content:ntext',
             ['label'=>'评论者','attribute'=>'type','value'=>function($model){
                 return $model->type == 1 ? '供应商' : '用户' ;
             }],
            [
                'attribute' => 'created_at',
                'value' =>function($model){
                    return date('Y-m-d H:i:s',$model->created_at);
                }
            ],
            // 'start',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a("查看", ['ordercompany/list'], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
            </div>
        </div>
    </div>
</div>