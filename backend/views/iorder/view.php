<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\IntegralOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Integral Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integral-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gid',
            'uid',
            'type',
            'express_company',
            'express_num',
            'is_del',
            'integral',
            'address',
            'contact',
            'mobile',
            'created_at',
            'updated_at',
            'ship_at',
            'order_sn',
        ],
    ]) ?>

</div>
