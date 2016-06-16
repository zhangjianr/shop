<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IntegralOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integral-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gid')->textInput() ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'express_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'express_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_del')->textInput() ?>

    <?= $form->field($model, 'integral')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ship_at')->textInput() ?>

    <?= $form->field($model, 'order_sn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
