<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Reply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'sid')->textInput() ?>

    <?= $form->field($model, 'did')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
