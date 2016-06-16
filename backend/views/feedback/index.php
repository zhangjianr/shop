<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商反馈';
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
                            'attribute' => 'uid',
                            'label' => '公司名',
                            'value' => 'companyReg.company_name',
                        ],
                        [
                            'attribute' => 'content',
                            'headerOptions' => ['width' => '500'],
                            'format' => ['html'],
                            'value' => function ($model) {
                                if (StringHelper::byteLength($model->content) < 80) {
                                    return $model->content;
                                } else
                                    return StringHelper::byteSubstr($model->content, 0, 80) . '......';
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return $model->status == $model::STATUS_FALSE ? '未处理' : '已处理';
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php: Y-m-d H:i:s'],
                        ],
                        // 'reply_content:ntext',
                        // 'status',
                        // 'type',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a($model->status == $model::STATUS_FALSE ? '处理' : "查看", $url, ['target' => '_blank']);
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
    menuheight('feedback-index');
");
?>
