<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '供应商注册';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="background-color: #F5F5F5;width: 80%;margin: auto;" class="site-signup">
    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="goods-form form-horizontal">
                <?php $form = ActiveForm::begin(['id' => 'form-signup',
                    'fieldConfig' => [
                        'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                        'labelOptions' => ['class' => 'col-sm-4 control-label'],
                        'inputOptions' => ['class' => 'form-control']
                    ]
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'company_name')->textInput() ?>

                <?= $form->field($model, 'company_tel')->textInput() ?>

                <?= $form->field($model, 'contact_name')->textInput() ?>

                <?= $form->field($model, 'phone')->textInput() ?>

                <?= $form->field($model, 'industry')->textInput() ?>

                <?= $form->field($model, 'password_hash')->passwordInput() ?>

                <div class="form-group field-SignupForm-id">
                    <label class="col-sm-4  control-label" for="SignupForm-id">城市</label>
                    <div class="col-sm-6" id="city">
                        <div class="col-sm-4">
                            <select class="prov form-control" id="SignupForm-province" name="SignupForm[province]"></select>
                        </div>
                        <div class="col-sm-4">
                            <select class="city form-control" id="SignupForm-city" name="SignupForm[city]" disabled="disabled"></select>
                        </div>
                        <div class="col-sm-4">
                            <select class="dist form-control" id="SignupForm-country" name="SignupForm[country]" disabled="disabled"></select>
                        </div>
                    </div>
                </div>

                <?= $form->field($model, 'company_address')->textInput() ?>

                <?= $form->field($model, 'introduct')->textarea() ?>

                <?= $form->field($model, 'license_num')->textInput() ?>

                <?= $form->field($model, 'license')->fileInput() ?>

                <?= $form->field($model, 'organization_num')->textInput() ?>

                <?= $form->field($model, 'organization')->fileInput() ?>

                <?= $form->field($model, 'tax_num')->textInput() ?>

                <?= $form->field($model, 'tax')->fileInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary col-sm-offset-3', 'name' => 'signup-button']) ?>
                    <?= Html::a('登陆', ['login'], ['class' => 'btn btn-success col-sm-offset-1']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php

$compuser = Yii::$app->session->getFlash('compuser') ? 1 : 0 ;

$script = <<<JS

if($compuser != 0){
    layer.alert("账号已存在", {icon: 6});
}

$("#city").citySelect({
     nodata: "none",    
     required: false
});
        
JS;

$this->registerJs($script);
?>

