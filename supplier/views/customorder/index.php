<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\CustomOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '定制订单列表';
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
                        'order_sn',
                        ['attribute' => 'status',
                            'value' => function($model){
                            return $model->status == 0 ? '未处理' : '以处理' ;
                        }],
                        [
                            'attribute' => 'created_at',
                            'value' => function($model){
                                return date('Y-m-d H:i:s',$model->created_at);
                            }
                        ],
//                        'contact',
//                        'tel',
//                        'cate_id',
//                        'company',
                        // 'content:ntext',
                        // 'order_sn',
                        // 'updated_at',
                        // 'over_at',

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