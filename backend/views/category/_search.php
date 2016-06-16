<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\ServiceCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-category-search text-right">

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


    <?= $form->field($model, 'name', ['template' => '{label} {input} ']) ?>


    <?php // echo $form->field($model, 'status') ?>


    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
