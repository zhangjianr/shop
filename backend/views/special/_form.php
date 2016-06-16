<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Image;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Special */
/* @var $form yii\widgets\ActiveForm */
AppAsset::addCss($this, '@web/plugins/datatimepicker/css/bootstrap-datetimepicker.min.css');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/bootstrap-datetimepicker.min.js');
AppAsset::addScript($this, '@web/plugins/datatimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js');

?>

    <div class="special-form  form-horizontal">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-1 control-label'],
                'inputOptions' => ['class' => 'form-control']
            ]
        ]); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'image_id')->fileInput() ?>

        <!- 图片显示 -->
        <div class="form-group">
            <?php if (!$model->isNewRecord && $model->image_id) : ?>
                <?= Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px", 'class' => 'col-sm-offset-1']) ?>
            <?php endif; ?>
        </div>

        <?= $form->field($model, 'starttime', ['template' => '{label}<div class="input-group date starttime col-md-3" data-link-field="starttime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd"><input class="form-control" size="16" type="text" value="' . $model->starttime . '" readonly> <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div><div class="col-sm-offset-2">{error}</div>{input}'])->hiddenInput(['id' => "starttime", 'class' => 'form-control']) ?>

        <?= $form->field($model, 'endtime', ['template' => '{label}<div class="input-group date endtime col-md-3" data-link-field="endtime" data-link-format="yyyy-mm-dd" data-date-format="yyyy-mm-dd"><input class="form-control" size="16" type="text" value="' . $model->endtime . '" readonly> <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div><div class="col-sm-offset-2">{error}</div>{input}'])->hiddenInput(['id' => 'endtime', 'class' => 'form-control']) ?>


        <?= $form->field($model, 'content')->widget('cliff363825\kindeditor\KindEditorWidget', ['clientOptions' => [
            //'langType' => 'zh_CN',
            'items' => [
                'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
                'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink', '|', 'about'
            ],
            'uploadJson' => Url::to(['/special/Kupload']),
        ]]) ?>


        <div class="form-group">
            <label for="" class="col-sm-2 control-label">已关联的商品</label>

            <div class="col-sm-6">
                <div class="row">
                    <div class="table-responsive" id= 'dgoods' style="overflow-y: scroll; height: 300px;">
                        <?php if(!$model->isNewRecord) : ?>
                            <?= GridView::widget([
                                'dataProvider' =>  $model->getRelationGoodsData(),
                                'summary'=> '',
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn',
                                        'checkboxOptions' => ['class' => 'check_childOne'],
                                    ],
                                    [
                                        'attribute' => 'service_name',
                                        'label' => '商品名',
                                        'format' => 'raw',
                                        'value' => 'service_name',
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => '操作',
                                        'template' => '{delete}',
                                        'buttons' => [
                                            'delete' => function ($url, $model, $key) {
                                                return Html::a('删除', '#', ['class' => 'delete']);
                                            }
                                        ],
                                    ]
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-2">
                        <a class="btn btn-info" data-toggle="modal" data-target="#addGoods"
                           data-backdrop="static">添加商品</a>
                    </div>
                    <div class="col-sm-3"><a id="delAll" class="btn btn-danger">删除选中商品</a></div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group text-center col-sm-6">
            <?= Html::submitButton($model->isNewRecord ? '保存' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

<?= $this->render('_goods') ?>

<?php
$date = date("Y-m-d");
$url = Url::toRoute("/special/goods");
$goodsUrl = Url::toRoute('/goods/view');
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


  //单个删除当前行
    $("#dgoods").on('click','td > a.delete', function (e) {
        e.preventDefault();
        var that = $(e.target);
        layer.confirm('您确定删除吗？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            that.parent().parent().remove();
            layer.msg('删除成功', {icon: 1, time: 100});
        });
    });

    //删除选中的多行信息
    $("#delAll").on('click', function (e) {
        e.preventDefault();
        layer.confirm('您确定删除吗？', {btn: ['确定', '取消']}, function () {
            $.each($("input.check_childOne:checked"), function (i, item) { // 遍历选中的checkbox
                $(item).parents("tr").remove();
            });
            layer.msg('删除成功', {icon: 1, time: 100});

        });
    });

    //关闭模态框添加商品
    $('#checkButton').on('click', function (e) {
        //获取checeboxid 和 titile 返回拼接
        var checkVal = $("input.check_child[name=checkGoods]");
        var data = [];
        $.each(checkVal, function (i, item) {
            if ($(item).prop('checked')) {
                var res = {"id": $(item).val(), "title": $(item).attr('title')};
                data.push(res);
            }
        });
        var str = '';
        var url = '';
        $.each(data, function (i, item) {
            url = "$goodsUrl";
            str += '<tr data-key="'+ item.id +'"><td><input type="checkbox" class="check_childOne" name="selection[]" value="' + item.id + '" checked = "true"></td><td>' +
                '<a href="' + url + '&id=' + item.id + '">' + item.title + '</a>' + '</td><td><a class="delete">删除</a></td></tr>';
        });
        $("#dgoods").find("tbody").empty();
        $("#dgoods").find("tbody").append(str);
    });

     //添加弹出关联视频
    $('#addVideo').on('show.bs.modal', function (e) {
        ajaxLoadVideo();
    });

     //添加弹出关联视频
    $('#addGoods').on('show.bs.modal', function (e) {
        ajaxLoadGoods();
    });


    //搜索
    $("#goodsSearch").on('click', function (e) {
        e.preventDefault();
        ajaxLoadGoods();
    });
    function ajaxLoadGoods() {

        var service_name = $('input[name=service_name]').val();
        var goodsUrl = "$goodsUrl";
        $.ajax({
            url: "$url",
            type: 'post',
            dataType: 'json',
            data: {service_name: service_name},
            success: function (data) {
                var str = '';
                $.each(data, function (i, item) {
                    str += '<tr><td><input type="checkbox" class="check_child" name="checkGoods" value="' + item.id + '" title="' + item.title + '"></td> <td><a href="' + goodsUrl + '&id=' + item.id + '" target="_blank">' + item.title + '</a></td></tr>';
                });
                $("#goodsTable > tbody").empty();
                $("#goodsTable > tbody").append(str);
            }
        });
    }
SCRIPT;
$this->registerJs($js);
?>