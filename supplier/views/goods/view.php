<?php

use yii\helpers\Html;
use common\models\Image;
use yii\widgets\DetailView;
use supplier\models\Attribute;
use supplier\models\ServiceType;
use supplier\models\ServiceCategory;

/* @var $this yii\web\View */
/* @var $model supplier\models\Goods */

$this->title = '商品详情';
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'service_name',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => Html::img(Image::getImage($model->image_id),['width'=> '200px', 'height'=>'200px'])
                        ],
                        [
                            'attribute' => 'service_cid',
                            'value' => ServiceCategory::findOne($model->service_cid)->name
                        ],
                        [
                            'attribute' => 'type_id',
                            'value' => ServiceType::findOne($model->type_id)->name
                        ],
                        [
                            'attribute' => 'attri_id',
                            'value' => Attribute::findOne($model->attri_id)->name
                        ],
                        'detail:ntext',
                        'created_at:date',
                        'updated_at:date',
//                        'is_del',
//                        'status',
                        'price',
                    ],
                    'template' => '<tr><th width="150px;">{label}</th><td>{value}</td></tr>',
                ]) ?>

            </div>
        </div>
    </div>
</div>
