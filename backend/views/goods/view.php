<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Image;
use backend\models\ServiceCategory;
use backend\models\ServiceType;
/* @var $this yii\web\View */
/* @var $model backend\models\Goods */

$this->title = "商品详情";
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
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
                        'service_name',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"])
                        ],
                        [
                            'attribute' => 'service_cid',
                            'value' => ServiceCategory::findOne($model->service_cid)->name,
                        ],
                        [
                            'attribute' => 'type_id',
                            'value' => ServiceType::findOne($model->type_id)->name,
                        ],
                        'detail:ntext',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ]
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

