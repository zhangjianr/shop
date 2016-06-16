<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IntegralOrder */

$this->title = 'Create Integral Order';
$this->params['breadcrumbs'][] = ['label' => 'Integral Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integral-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
