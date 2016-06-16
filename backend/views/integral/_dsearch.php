<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\IntegralSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integral-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['deal'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>


    <?= $form->field($model, 'mobile', ['template' => '{label} {input} '])->label('手机号') ?>

    <?= $form->field($model, 'name', ['template' => '{label} {input} '])->label('昵称') ?>


    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('清空', ['/integral/deal'], ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
