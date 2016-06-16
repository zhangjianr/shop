<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model supplier\models\OrderCompany */

$this->title = 'Update Order Company: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
