<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>


    <?= $form->field($model, 'order_sn', ['template' => '{label} {input}']) ?>

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


    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
