<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model supplier\models\Reply */

$this->title = '评论订单';
$this->params['breadcrumbs'][] = ['label' => 'Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'order_id' => $order_id,
                    'uid' => $uid,
                ]) ?>
            </div>
        </div>
    </div>
</div>

