<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Image;
use yii\helpers\ArrayHelper;
use backend\models\IntegralOrder;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\IntegralOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '积分订单列表';
$this->params['breadcrumbs'][] = $this->title;
$iorderModel = new IntegralOrder();
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
                            'attribute' => 'igoods.image_id',
                            'format' => 'raw',
                            'label' => '图片',
                            'value' => function ($model) {
                                return Html::img(Image::getImage($model->igoods->image_id), ['width' => "100px", 'height' => "100px"]);
                            }
                        ],
                        [
                            'attribute' => 'igoods.name',
                            'label' => '商品名',
                            'value' => 'igoods.name'
                        ],
                        [
                            'attribute' => 'person.name',
                            'label' => '兑换人',
                            'value' => 'person.name'
                        ],
                        [
                            'attribute' => 'user.mobile',
                            'label' => '手机号',
                            'value' => 'user.mobile'
                        ],
                        'integral',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php: Y-m-d H:i:s']
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{ship}',
                            'buttons' => [
                                'ship' => function ($url, $model, $key) {
                                    return Html::a($model->type == $model::TYPE_FALSE ? '发货' : '已发货','#', $model->type == $model::TYPE_FALSE ? ['class' => 'iOrder', 'data-toggle' => 'modal', 'data-target' => '#iOrder', 'data' => json_encode(ArrayHelper::toArray($model))] : []);
                                }
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?=  $this->render('_modal', ['model' => $iorderModel]) ?>

<?php
$this->registerJs("
    $('.iOrder').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#IntegralOrder').find('#integralorder-express_company').val(data.express_company);
        $('#IntegralOrder').find('#integralorder-express_num').val(data.express_num);
    });
    menuheight('iorder-index');
");
?>
