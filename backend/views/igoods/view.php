<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Image;
/* @var $this yii\web\View */
/* @var $model backend\models\IntegralGoods */

$this->title = "积分商品详情";
$this->params['breadcrumbs'][] = ['label' => 'Integral Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"])
                        ],
                        'integral',
                        'content:html',
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
