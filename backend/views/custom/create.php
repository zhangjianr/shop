<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomOrder */

$this->title = 'Create Custom Order';
$this->params['breadcrumbs'][] = ['label' => 'Custom Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
