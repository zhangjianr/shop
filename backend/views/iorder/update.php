<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IntegralOrder */

$this->title = 'Update Integral Order: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Integral Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="integral-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
