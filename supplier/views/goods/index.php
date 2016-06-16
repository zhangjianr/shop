<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'service_name',
            'image_id',
            'service_cid',
            'type_id',
            // 'attri_id',
            // 'detail:ntext',
            // 'created_at',
            // 'updated_at',
            // 'is_del',
            // 'status',
            // 'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
