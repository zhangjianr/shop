<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//废弃页面
/* @var $this yii\web\View */
/* @var $model backend\models\searchs\AttributeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-search text-right">

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


    <?= $form->field($model, 'name', ['template' => '{label} {input}']) ?>

    <?= $form->field($model, 'value', ['template' => '{label} {input}']) ?>

    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
