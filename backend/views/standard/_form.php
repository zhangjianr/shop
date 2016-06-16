<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'order_sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'order_status')->textInput() ?>

    <?= $form->field($model, 'order_fail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_status')->textInput() ?>

    <?= $form->field($model, 'pay_note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inv_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_service')->textInput() ?>

    <?= $form->field($model, 'over_at')->textInput() ?>

    <?= $form->field($model, 'start_at')->textInput() ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
