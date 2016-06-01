<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wxnewreply */

$this->title = 'Update Wxnewreply: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wxnewreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wxnewreply-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
