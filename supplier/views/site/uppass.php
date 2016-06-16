<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '修改企业密码';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="goods-form form-horizontal">

                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
                                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ],
                        'enableAjaxValidation' => true,
                    ]); ?>

                    <div class="form-group field-signupform-company_name">
                        <label class="col-sm-2 control-label" for="signupform-company_name">账号</label><div class="col-sm-3"><p class="help-block help-block-error"></p><?= Yii::$app->user->identity->company_name ?></div>
                    </div>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'password_hash')->passwordInput() ?>

                    <?= $form->field($model, 'password_hash_two')->passwordInput() ?>

                    <?= $form->field($model, 'id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>

                    <div class="form-group text-center col-sm-4">
                        <?= Html::submitButton('确认', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
$js = "$('#w0').submit(function(){
    var pass = $('#signupform-password_hash').val();
    var passt = $('#signupform-password_hash_two').val();
    if(pass != passt){
        layer.msg('两次密码不一致');
        return false;
    }else if(pass == ''){
        return false;
    }
});";

$this->registerJs($js);
?>

