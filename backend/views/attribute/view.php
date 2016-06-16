<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ServiceType;
use backend\models\ServiceCategory;
/* @var $this yii\web\View */
/* @var $model backend\models\Attribute */

$this->title = "属性详情";
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['index']];
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
                        'value',
                        [
                            'attribute' => 'cate_id',
                            'value' => ServiceCategory::findOne($model->cate_id)->name,
                        ],
                        [
                            'attribute' => 'type_id',
                            'value' => ServiceType::findOne($model->type_id)->name,
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        'sort',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>