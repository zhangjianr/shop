<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\core\lib\Constants;
/* @var $this yii\web\View */
/* @var $model backend\models\searchs\IntegralGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integral-goods-search text-right">

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

    <?= $form->field($model, 'shelves')->dropDownList(Constants::getGoodsStatus(), ['prompt' => '请选择']) ?>
    &nbsp;&nbsp;
    <?= $form->field($model, 'name', ['template' => '{label} {input}']) ?>
    &nbsp;&nbsp;

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>


    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
