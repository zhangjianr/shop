<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\CouponsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '优惠券';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= Html::a('添加优惠券', ['create'], ['class' => 'btn btn-success']) ?>
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'number',
                        'name',
                        [
                            'attribute' => 'starttime',
                            'label' => '有效期',
                            'value' => function ($model) {
                                return $model->starttime == 0 && $model->endtime == 0 ? "用完为止" : date('Y-m-d H:i:s', $model->starttime) . '-' . date('Y-m-d H:i:s', $model->endtime);
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php: Y-m-d H:i:s']
                        ],
                        [
                            'attribute' => 'endtime',
                            'label' => '状态',
                            'value' => function ($model) {
                                return $model->starttime > time() ? '未开始' : ($model->endtime < time() ? '已结束' : '展示中');
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update} | {list}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('编辑', $url);
                                },
                                'list' => function ($url, $model, $key) {
                                    return Html::a('列表', ['/coupons/list', 'id' => $key]);
                                }
                            ]
                        ],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    menuheight('coupons-index');
");
?>