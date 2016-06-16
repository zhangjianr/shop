<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use backend\models\Person;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\IntegralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '积分操作';
$this->params['breadcrumbs'][] = $this->title;
$dealModel = new Person();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <?= $this->render('_dsearch', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'user.mobile',
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
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => "{deal}",
                            'buttons' => [
                                'deal' => function ($url, $model, $key) {
                                    return Html::a('处理', '#', ['class' => 'deal', 'data-toggle' => 'modal', 'data-target' => '#deal', 'data' => json_encode(ArrayHelper::toArray($model->person))]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('_dmodal', ['model' => $dealModel]) ?>
<?php
$this->registerJs("
    $('.deal').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#Person').find('#personName').html(data.name);
    });
    menuheight('integral-deal');
");
?>

