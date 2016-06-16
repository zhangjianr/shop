<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'order_sn',
            'uid',
            'order_status',
            'order_fail',
            // 'pay_status',
            // 'type',
            // 'pay_note',
            // 'inv_type',
            // 'created_at',
            // 'updated_at',
            // 'order_service',
            // 'over_at',
            // 'start_at',
            // 'brand_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
