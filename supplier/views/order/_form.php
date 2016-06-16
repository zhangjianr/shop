<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model supplier\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'order_status')->textInput() ?>

    <?= $form->field($model, 'order_fail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_status')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'pay_note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inv_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'order_service')->textInput() ?>

    <?= $form->field($model, 'over_at')->textInput() ?>

    <?= $form->field($model, 'start_at')->textInput() ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
