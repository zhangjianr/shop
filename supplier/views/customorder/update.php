<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model supplier\models\CustomOrder */

$this->title = 'Update Custom Order: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Custom Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="custom-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
