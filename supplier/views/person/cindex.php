<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '业务客户';
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
                        'name',
                        ['attribute'=>'sex','value'=>function($model){
                            return $model->sex == 1 ? '男' : '女' ;
                        }],
                        'age',
                        'profession',
                        'integral',
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