<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wxreply */

$this->title = 'Update Wxreply: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wxreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
