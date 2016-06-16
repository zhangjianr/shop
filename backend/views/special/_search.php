<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\SpecialSearch */
/* @var $form yii\widgets\ActiveForm */

AppAsset::addCss($this, '@web/plugins/datatimepicker/css/bootstrap-datetimepicker.min.css');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/bootstrap-datetimepicker.min.js');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js');
?>

    <div class="special-search text-right">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'class' => 'form-inline',
            ],
            'fieldConfig' => [
                'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
                'inputOptions' => ['class' => 'form-control']
            ]
        ]); ?>

        <?= $form->field($model, 'title', ['template' => '{label} {input} ']) ?>


        <?= $form->field($model, 'starttime', ['template' => '
        {label}<div class="input-group date starttime col-md-8" data-link-field="starttime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
        <input class="form-control" size="16" type="text" value="" readonly>
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>{input}
        '])->hiddenInput(['id' => "starttime", 'class' => 'form-control']) ?>

        <?= $form->field($model, 'endtime', ['template' => '
        {label}<div class="input-group date endtime col-md-8" data-link-field="endtime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
        <input class="form-control" size="16" type="text" value="" readonly>
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>{input}
        '])->hiddenInput(['id' => 'endtime', 'class' => 'form-control']) ?>


        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


        <?php ActiveForm::end(); ?>

    </div>
<?php
$date = date("Y-m-d");
$js = <<<SCRIPT
    //var date = "$date";
    var start = {
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        showMeridian: true,
      //  startDate: date,
        //minuteStep: 10,
        language: 'zh-CN',
        minView: "month"
    };
    var end = {
        format: "yyyy-mm-dd",
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