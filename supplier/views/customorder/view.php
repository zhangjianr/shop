<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model supplier\models\CustomOrder */

$this->title = '定制订单详情';
$this->params['breadcrumbs'][] = ['label' => 'Custom Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'order_sn',
                        'contact',
                        'tel',
                        'content:ntext',
//                        'cate_id',
//                        'company',
//                        'created_at',
//                        'updated_at',
//                        'over_at',
                        [
                            'label' => '关联的客户',
                            'attribute' => 'contact',
                            'format' => 'raw',
                            'value' => $model->contact.Html::a("查看", ['person/cview','uid'=>$model->uid], ['class' => 'col-sm-offset-1']),
                        ],
                    ],
                    'template' => '<tr><th width="150px;">{label}</th><td>{value}</td></tr>',
                ]) ?>

            </div>
        </div>
    </div>
</div>
