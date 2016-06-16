<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\core\lib\Constants;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '标准服务订单';
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
                        [
                            'attribute' => 'uid',
                            'value' => function ($model) {
                                return User::findOne($model->uid)->username;
                            }
                        ],
                        [
                            'attribute' => 'order_status',
                            'value' => function($model) {
                                return Constants::getOrderStatus()[$model->order_status];
                            }
                        ],
                        'order_fail',
                        // 'pay_status',
                        // 'type',
                        // 'pay_note',
                        // 'inv_type',
                        // 'created_at',
                        // 'updated_at',
                        // 'order_service',
                        // 'over_at',
                        // 'start_at',
                        // 'brand_id',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view} {bind} {status}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('查看', $url, ['class' => 'btn btn-primary']);
                                },
                                'bind' => function ($url, $model, $key) {
                                    $disable = $model->order_status == $model::STATUS_FAIL ? true : false;
                                    return Html::button('供应商', ['class' => 'btn btn-warning sendBind', 'data-toggle' => 'modal', 'data-target' => '#sendBind', 'data-id' => $key, 'disabled' => $disable]);
                                },
                                'status' => function ($url, $model, $key) {
                                    return Html::button('状态', ['class' => 'btn btn-success sendStatus', 'data-toggle' => 'modal', 'data-target' => '#sendStatus', 'data-id' => $key]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('_status', ['model' => $statusModel]) ?>

<?= $this->render('_bind', ['model' => $bindModel, 'bindProvider' => $bindProvider]) ?>

<?php
$this->registerJs("
        $('.sendStatus').on('click', function (e) {
            e.preventDefault();
            var uid = $(this).attr('data-id');
            $('#sid').val(uid);
        });
        $('.sendBind').on('click', function (e) {
            e.preventDefault();
            var uid = $(this).attr('data-id');
            $('#bid').val(uid);
        });
        menuheight('standard-index');
    ");
?>
