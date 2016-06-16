<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\CouponsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupons-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'cname', ['template' => '{label} {input}'])->label('优惠券名称') ?>

    <?php // echo $form->field($model, 'is_use') ?>

    <?php // echo $form->field($model, 'total_num') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
