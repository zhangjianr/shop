<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WxReplyMult */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wx Reply Mults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-reply-mult-view">

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
            'keyword',
            'keyword_type',
            'mult_ids',
        ],
    ]) ?>

</div>
