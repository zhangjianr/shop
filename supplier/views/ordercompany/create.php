<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model supplier\models\OrderCompany */

$this->title = 'Create Order Company';
$this->params['breadcrumbs'][] = ['label' => 'Order Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
