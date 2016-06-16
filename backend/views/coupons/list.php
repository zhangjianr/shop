<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\CouponsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '券号';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= $this->render('_listSearch', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'number',
                            'label' => '券号',
                        ],
                        [
                            'attribute' => 'status',
                            'label' => '状态',
                            'value' => function ($model) {
                                return $model->status == $model::STATUS_UNUSE ? '未使用' : '已使用';
                            }
                        ],
                        [
                            'attribute' => 'order.order_sn',
                            'label' => '订单号'
                        ],
                        [
                            'attribute' => 'uid',
                            'label' => '使用人'
                        ],
                        [
                            'attribute' => 'use_time',
                            'label' => '使用时间',
                            'value' => function ($model) {
                                return $model->use_time == 0 ? '(暂无)' : (date('Y-m-d H:i:s', $model->use_time));
                            }
                        ]
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
    menuheight('coupons-list');
");
?>