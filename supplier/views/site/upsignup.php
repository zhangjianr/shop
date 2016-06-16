<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use common\models\Image;
use yii\bootstrap\ActiveForm;
use common\core\lib\Constants;

$this->title = '修改企业信息';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-2 control-label">审核状态</label>
                    <div><?= Constants::getAudit($model->status) ?></div><br/>
                    <?php
                    if($model->status == 2) {
                        ?>
                        <div class="col-sm-1"></div>
                        <label class="col-sm-2 control-label">未通过原因</label>
                        <div><?= $model->deny_info ?></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="goods-form form-horizontal">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-4">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-2  control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ]
                    ]); ?>

                    <div class="form-group field-companyreg-id">
                        <label class="col-sm-2  control-label" for="companyreg-id">ID</label><div class="col-sm-4"><p class="help-block help-block-error"></p><?= Yii::$app->user->identity->id ?></div>
                    </div>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'company_name')->textInput() ?>

                    <?php // $form->field($model, 'company_tel')->textInput() ?>


                    <?= $form->field($model, 'contact_name')->textInput() ?>

                    <?= $form->field($model, 'company_tel')->textInput() ?>

                    <?= $form->field($model, 'license_num')->textInput() ?>

                    <?= $form->field($model, 'license')->fileInput() ?>

                    <div class="form-group field-companyreg-id">
                        <label class="col-sm-2  control-label" for="companyreg-id"></label>

                        <?= Html::img(Image::getImage($model->license),['width'=> '200px', 'height'=>'200px']) ?>

                    </div>
                    <div style="height: 5rem;"></div>

                    <?= $form->field($model, 'organization_num')->textInput() ?>

                    <?= $form->field($model, 'organization')->fileInput() ?>

                    <div class="form-group field-companyreg-id">
                        <label class="col-sm-2  control-label" for="companyreg-id"></label>

                        <?= Html::img(Image::getImage($model->organization),['width'=> '200px', 'height'=>'200px']) ?>

                    </div>
                    <div style="height: 5rem;"></div>

                    <?= $form->field($model, 'tax_num')->textInput() ?>

                    <?= $form->field($model, 'tax')->fileInput() ?>

                    <div class="form-group field-companyreg-id">
                        <label class="col-sm-2  control-label" for="companyreg-id"></label>

                        <?= Html::img(Image::getImage($model->tax),['width'=> '200px', 'height'=>'200px','class'=>'col-sm-offset-1;']) ?>

                    </div>
                    <div style="height: 5rem;"></div>

                    <div class="form-group field-companyreg-id">
                        <label class="col-sm-2  control-label" for="companyreg-id">城市</label>
                        <div class="col-sm-6" id="city">
                            <div class="col-sm-4">
                                <select class="prov form-control" id="companyreg-province" data="<?= $model->province ?>" name="CompanyReg[province]"></select>

                            </div>
                            <div class="col-sm-4">
                                <select class="city form-control" id="companyreg-city" data="<?= $model->city ?>" name="CompanyReg[city]" disabled="disabled"></select>
                            </div>
                            <div class="col-sm-4">
                                <select class="dist form-control" id="companyreg-country" data="<?= $model->country ?>" name="CompanyReg[country]" disabled="disabled"></select>
                            </div>
                        </div>
                    </div>

                    <?= $form->field($model, 'company_address')->textInput() ?>

                    <?= $form->field($model, 'industry')->textInput() ?>

                    <?= $form->field($model, 'introduct')->textarea() ?>

                    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('确认', ['class' => 'btn btn-primary col-sm-offset-2', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php

$upusername = Yii::$app->session->getFlash('upusername') ? 1 : 0;

$js = <<<JS

if($upusername != 0){
    layer.alert("账号以存在", {icon: 6});
}

var province = $("#companyreg-province").attr("data");
var city = $("#companyreg-city").attr("data");
var country = $("#companyreg-country").attr("data");
    $("#city").citySelect({
        prov: province,
        city: city,
        dist: country,
        nodata: "none",
        required: false
    })
    
JS;

$this->registerJs($js);

?>