<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\IntegralOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integral-order-search text-right">

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

    <?= $form->field($model, 'goodsname', ['template' => '{label} {input} '])->label('商品名') ?>

    <?= $form->field($model, 'uname', ['template' => '{label} {input} '])->label('兑换人') ?>

    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>

    <?= Html::a('清空', ['/integral/deal'], ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
