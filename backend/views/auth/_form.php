<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group text-center  col-sm-6">
        <?= Html::submitButton('创建', ['class' =>  'btn btn-success' ]) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
