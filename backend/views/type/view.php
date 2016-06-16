<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ServiceCategory;
/* @var $this yii\web\View */
/* @var $model backend\models\ServiceType */

$this->title = "服务类型详情";
$this->params['breadcrumbs'][] = ['label' => 'Service Types', 'url' => ['index']];
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
                        'name',
                        [
                            'attribute' => 'service_cid',
                            'value' =>  ServiceCategory::findOne($model->service_cid)->name
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                        ],
                        'sort',
                        [
                            'attribute' => 'status',
                            'value' => $model->status == 1 ? '显示' : '隐藏',
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>