<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
    <!-- left column -->
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-10">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">配置微信公共号</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal'],
                'fieldConfig'=>[
                    'template'=>'<div class="form-group">{label}<div class="col-sm-5">{input}{error}</div></div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'inputOptions' => ['class' => 'form-control input-lg']
                ]]);?>
            <div class="box-body">
                <?= $form->field($model, 'keyword')->textInput(['id'=>'inputEmail3','placeholder'=>'关键词']) ?>
            </div>
            <div class="box-footer">
                <?= Html::resetButton('清除', ['class'=>'btn btn-default col-sm-offset-3']) ?>
                <?= Html::submitButton('提交', ['class' => 'btn btn-info']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
