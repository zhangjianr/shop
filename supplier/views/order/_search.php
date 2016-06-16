<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model supplier\models\searchs\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_sn') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'order_status') ?>

    <?= $form->field($model, 'order_fail') ?>

    <?php // echo $form->field($model, 'pay_status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'pay_note') ?>

    <?php // echo $form->field($model, 'inv_type') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'order_service') ?>

    <?php // echo $form->field($model, 'over_at') ?>

    <?php // echo $form->field($model, 'start_at') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
