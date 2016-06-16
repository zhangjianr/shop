<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model supplier\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'uid')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'content')->textarea(['cols'=>5,'rows'=>10,'style'=>'width:60rem;']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
