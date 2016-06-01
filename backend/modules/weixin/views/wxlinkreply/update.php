<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wxlinkreply */

$this->title = 'Update Wxlinkreply: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wxlinkreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wxlinkreply-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
