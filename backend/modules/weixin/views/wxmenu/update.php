<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wxmenu */

$this->title = '修改自定义菜单';
$this->params['breadcrumbs'][] = ['label' => 'Wxmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wxmenu-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
