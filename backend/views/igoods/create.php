<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IntegralGoods */

$this->title = '添加积分商品';
$this->params['breadcrumbs'][] = ['label' => 'Integral Goods', 'url' => ['index']];
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
