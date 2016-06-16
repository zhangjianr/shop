<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\Keyword;

$this->title = '添加链接回复';
?>
    <div class="row">
        <div class="col-md-11">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加链接回复</h3>
                </div>
                <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal'],
                    'fieldConfig'=>[
                        'template'=>'<div class="form-group">{label}<div class="col-sm-5">{input}{error}</div></div>',
                        'labelOptions' => ['class' => 'col-sm-2 control-label'],
                        'inputOptions' => ['class' => 'form-control input-lg']
                    ]]);?>
                <div class="box-body">
                    <?= $form->field($model, 'keyword')->textInput(['style'=>'width:20rem;'])?>
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'标题']) ?>
                    <?= $form->field($model, 'description')->textarea(['placeholder'=>'简介']) ?>
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder'=>'链接地址']) ?>
                    <?= $form->field($model, 'image_id')->fileInput() ?>
                </div>
                <div class="box-footer">
                    <?= Html::resetButton('清除', ['class'=>'btn btn-default col-sm-offset-3']) ?>
                    <?= Html::submitButton('提交', ['class' => 'btn btn-info']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php

$sortnum = Yii::$app->session->getFlash('sortnum') ? 1 : 0 ;

$script = <<<JS

if($sortnum != 0){
    layer.alert("每个关键词最多只能同时回复七条图文 此关键词已达上限", {icon: 5});
}

JS;

$this->registerJs($script);