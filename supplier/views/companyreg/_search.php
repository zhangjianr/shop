<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model supplier\models\searchs\CompanyRegSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-reg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'company_tel') ?>

    <?= $form->field($model, 'company_address') ?>

    <?= $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'industry') ?>

    <?php // echo $form->field($model, 'introduct') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'organization') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'license') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
