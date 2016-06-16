<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model supplier\models\CustomOrder */

$this->title = '新增定制订单';
$this->params['breadcrumbs'][] = ['label' => 'Custom Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-order-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
