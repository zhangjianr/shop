<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\FeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['uindex'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'uid', ['template' => '{label} {input} '])->label('手机号') ?>
    <?= $form->field($model, 'id', ['template' => '{label} {input} '])->label('昵称') ?>

    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
