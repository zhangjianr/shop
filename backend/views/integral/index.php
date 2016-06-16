<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use backend\models\Integral;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\IntegralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '积分历史列表';
$this->params['breadcrumbs'][] = $this->title;
$markModel = new Integral();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
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
                            'attribute' =>'user.mobile',
                            'label' => '手机号',
                            'value' => 'user.mobile',
                        ],
                        [
                            'attribute' => 'person.name',
                            'label' => '昵称',
                            'value' => 'person.name',
                        ],
                        'integral',
                        [
                            'attribute' => 'description',
                            'headerOptions' => ['width' => '500'],
                            'format' => ['html'],
                            'value' => function ($model) {
                                if (StringHelper::byteLength($model->description) < 80) {
                                    return $model->description;
                                } else
                                    return StringHelper::byteSubstr($model->description, 0, 80) . '......';
                            }
                        ],
                        [
                            'attribute' =>'created_at',
                            'format' => ['date', 'php: Y-m-d H:i:s'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => "{view}",
                            'buttons' => [
                                'view' => function($url, $model, $key) {
                                    return Html::a('查看备注', '#', ['class' => 'markInfo', 'data-toggle' => 'modal', 'data-target' => '#markInfo', 'data' => json_encode(ArrayHelper::toArray($model))]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('_mark', ['model' => $markModel]) ?>

<?php
$this->registerJs("
    $('.markInfo').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#Integral').find('#integral-description').val(data.description);
    });
    menuheight('integral-index');
");
?>
