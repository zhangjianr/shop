<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加关键词';
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
                        <h3 class="box-title">配置微信公共号</h3>
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
                        <?= $form->field($model, 'keyword')->textInput(['id'=>'inputEmail3','placeholder'=>'关键词']) ?>
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <?= $form->field($model, 'status')->inline()->radioList([1 => "文本回复", 2 => "图文回复",3 => "连接回复"])->label(false) ?>
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

