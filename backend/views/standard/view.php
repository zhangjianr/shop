<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\CompanyReg;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = "标准订单详情";
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?></h3>
            </div>
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'order_sn',
                        'uid',
                        'order_status',
                        'order_fail',
                        'pay_status',
                        'type',
                        'pay_note',
                        'inv_type',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        'order_service',
                        'over_at',
                        'start_at',
                        'goods_id',
                    ],
                ]) ?>
                <?php Pjax::begin(['id' => 'ocompany-list']) ?>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => "<br>",
                    'columns' => [
                        [
                            'attribute' => 'company_id',
                            'value' => function ($model) {
                                return CompanyReg::findOne($model->company_id)->company_name;
                            }
                        ],
                        [
                            'attribute' => 'create_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => "{bind}",
                            'buttons' => [
                                'bind' => function ($url, $model, $key) {
                                    return Html::button('解绑', ['class' => 'btn btn-primary', 'onclick' => '
                            layer.confirm("您确定解除绑定当前供应商吗?", {
                                btn: ["确定", "取消"]
                            }, function(){
                                 var id = "' . $key . '";
                                 var url = "' . \yii\helpers\Url::toRoute('/ocompany/delete') . '";
                                 $.post(url, {id : id}, function(data){
                                    if(data.status){
                                        $.pjax.reload({container:"#ocompany-list"});

                                    }
                                })
                            });
                        ']);
                                }
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>
