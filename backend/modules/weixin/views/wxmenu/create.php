<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wxmenu */

    $this->title = '添加自定义菜单';
$this->params['breadcrumbs'][] = ['label' => 'Wxmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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