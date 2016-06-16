<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\CustomOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '定制服务订单';
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
                        'contact',
                        'tel',
                        'cate_id',
                        // 'content:ntext',
                        // 'order_sn',
                        // 'created_at',
                        // 'updated_at',
                        // 'over_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view} {status}',
                            'buttons' => [
                                'view' => function($url, $model, $key) {
                                    return Html::a('查看', $url, ['class' => 'btn btn-primary']);
                                },
                                'status' => function($url, $model, $key) {
                                    return Html::button('状态', ['class' => 'btn btn-primary']);
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
    menuheight('custom-index');
");
?>