<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
/* @var $this yii\web\View */
/* @var $model backend\models\ServiceType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-type-form  form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_cid')->dropDownList(
        ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_TRUE]), 'id', 'name'),
        ['prompt' => '请选择']
    ) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->inline()->radioList([1 => '显示', 0 => '隐藏']) ?>

    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
