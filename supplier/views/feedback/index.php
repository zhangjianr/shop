<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '给大平台留言';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body">

                <p>
                    <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [

                        'id',
                        'content:ntext',
                        [
                            'attribute' => 'created_at',
                            'value' => function($model){
                                return date('Y-m-d H:i:s',$model->created_at);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a("查看", $url, ['class' => 'btn btn-primary']);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>