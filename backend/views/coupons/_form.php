<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model backend\models\Coupons */
/* @var $form yii\widgets\ActiveForm */
AppAsset::addCss($this, '@web/plugins/datatimepicker/css/bootstrap-datetimepicker.min.css');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/bootstrap-datetimepicker.min.js');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js');

?>

<div class="coupons-form form-horizontal">
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('优惠券名称') ?>
    <?= $form->field($model, 'number')->textInput(['maxlength' => true])->label('数量') ?>
    <?= $form->field($model, 'starttime', ['template' => '{label}<div class="input-group date starttime col-md-3" data-link-field="starttime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd"><input class="form-control" size="16" type="text"  placeholder = "不限" name="Coupons[starttime]" value="' . ($model->starttime == 0 ? "不限" : date('Y-m-d H:i:s', $model->starttime)) . '" readonly> <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div><div class="col-sm-offset-2">{error}</div>{input}'])->hiddenInput(['id' => "starttime", 'class' => 'form-control']) ?>

    <?= $form->field($model, 'endtime', ['template' => '{label}<div class="input-group date endtime col-md-3" data-link-field="endtime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd"><input class="form-control" size="16" type="text" placeholder = "不限" name="Coupons[endtime]"  value="' . ($model->endtime == 0 ? "不限" : date('Y-m-d H:i:s', $model->endtime)) . '" readonly> <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div><div class="col-sm-offset-2">{error}</div>{input}'])->hiddenInput(['id' => 'endtime', 'class' => 'form-control']) ?>


    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'cols' => 8, 'rows' => 8]) ?>

    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('返回列表', ['index'] ,['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$date = date("Y-m-d");
$js = <<<SCRIPT
    var date = "$date";
    var start = {
        format: "yyyy-mm-dd HH:ii:ss",
        autoclose: true,
        todayBtn: true,
        showMeridian: true,
      //  startDate: date,
        //minuteStep: 10,
        language: 'zh-CN',
        minView: "month"
    };
    var end = {
        format: "yyyy-mm-dd HH:ii:ss",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true,
        showMeridian: true,
     //   startDate: date,
        //minuteStep: 10,
        language: 'zh-CN',
        minView: "month"
    };
    //选定开始时间重置  结束时间的最小时间
    $(".starttime").datetimepicker(start)
        .on('changeDate', function () {
            var newEndStartTime = $("#starttime").val();
            $(".endtime").datetimepicker("setStartDate", newEndStartTime);
        });
    //选定结束时间  重置  开始时间的最大时间
    $(".endtime").datetimepicker(end)
        .on('changeDate', function () {
            var newStartEndTime = $("#endtime").val();
            $(".starttime").datetimepicker("setEndDate", newStartEndTime);
        });


SCRIPT;
$this->registerJs($js);
?>