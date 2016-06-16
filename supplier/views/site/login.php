<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '企业管理后台';
$this->params['breadcrumbs'][] = $this->title;

?>

    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b><?= Html::encode($this->title) ?></b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"></p>

            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'username')->textInput(['class'=>'form-control','autofocus'=>true,'placeholder'=>'用户名'])->label(false) ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'password_hash')->passwordInput(['type'=>'password','class'=>'form-control','placeholder'=>'密码'])->label(false) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck" style="margin-top: -10px !important;">
                        <label>
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        </label>
                        <br>
                        <?= Html::a('注册', ['signup']) ?>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
                </div>
                <!-- /.col -->
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </body>
<?php
$this->registerJs('
$(function () {
    $("input").iCheck({
      checkboxClass: "icheckbox_square-blue",
      radioClass: "iradio_square-blue",
      increaseArea: "20%"
    });
  });
');
?>