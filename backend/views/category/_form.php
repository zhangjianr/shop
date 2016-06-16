<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\ServiceCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-category-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-4 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





