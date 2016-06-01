<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\Keyword;

$this->title = '添加链接回复';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-weixin text-green"></i> 微信</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">公众号管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-11">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加链接回复</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal'],
                        'fieldConfig'=>[
                            'template'=>'<div class="form-group">{label}<div class="col-sm-9">{input}{error}</div></div>',
                            'labelOptions' => ['class' => 'col-sm-2 control-label'],
                            'inputOptions' => ['class' => 'form-control input-lg']
                        ]]);?>
                        <div class="box-body">
                            <?= $form->field($model, 'kid')->dropdownList(
                                Keyword::find()->select(['keyword', 'id'])->indexBy('id')->column(),['style'=>'width:20rem;'])?>
                            <?= $form->field($model, 'sort')->textInput(['max'=>2,'style'=>'width:5rem;']) ?>
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'标题']) ?>
                            <?= $form->field($model, 'description')->textInput(['maxlength' => true,'placeholder'=>'简介']) ?>
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder'=>'链接地址']) ?>
                            <?php
                            echo \kato\DropZone::widget([
                                'options' => [
                                    'url' => Url::toRoute('/weixin/wxreply/upload'),
                                    'maxFilesize' => '2',
                                    'maxFiles' => 1,
                                    'acceptedFiles' => '.jpeg,.png,.jpg',
                                    'dictDefaultMessage' => "请拖拽图片到此框内",
                                    'addRemoveLinks' => true,
                                    'dictRemoveLinks' => "x",
                                    'dictCancelUpload' => "x",
                                    'dictRemoveFile' => '删除',
                                    'dictMaxFilesExceeded' => '仅支持单个图片上传',
                                ],
                                'clientEvents' => [
                                    'complete' => "function(random){console.log(random)}", //上传完成事件
                                    'removedfile' => "function(file){console.log(file.name + ' is removed')}", //删除图片响应事件
                                    "maxfilesexceeded" => "function(file) {this.removeAllFiles();this.addFile(file);}", //添加单个图片
                                    "success" => "function(file, response){input=top.document.getElementsByName('Wxreply[picurl]');input[0].value=response;}" // 成功后获取响应返回的值
                                ],
                            ]);
                            ?>
                            <?= $form->field($model, 'picurl')->hiddenInput()->label(false) ?>
                        </div>
                        <div class="box-footer">
                            <?= Html::resetButton('清除', ['class'=>'btn btn-default']) ?>
                            <?= Html::submitButton('提交', ['class' => 'btn btn-info pull-right']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php

$sortnum = Yii::$app->session->getFlash('sortnum') ? 1 : 0 ;

$script = <<<JS

if($sortnum != 0){
    layer.alert("每个关键词最多只能同时回复七条图文 此关键词已达上限", {icon: 5});
}

JS;

$this->registerJs($script);