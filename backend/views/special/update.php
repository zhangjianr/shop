<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Special */

$this->title = '修改专题';
$this->params['breadcrumbs'][] = ['label' => 'Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
