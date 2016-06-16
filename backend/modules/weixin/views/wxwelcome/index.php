<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\WxWelcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wx Welcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-welcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wx Welcome', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'kid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>