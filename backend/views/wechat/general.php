<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '公众号管理';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            公众号管理
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
                        <?php $form = ActiveForm::begin(['method'=>'post','options'=>['class'=>'form-horizontal']]); ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">appid</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="inputEmail3" placeholder="appid">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">appsecret</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="inputPassword3" placeholder="appsecret">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">token</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="inputPassword3" placeholder="token">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">原始id</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="inputPassword3" placeholder="原始id">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">清除</button>
                            <button type="submit" class="btn btn-info pull-right">提交</button>
                        </div>
                        <!-- /.box-footer -->
                    <?php ActiveForm::end() ?>
                </div>
                <!-- /.box -->
                <!-- general form elements disabled -->
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>