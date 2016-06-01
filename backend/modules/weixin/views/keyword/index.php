<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = '后台';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('table{text-align:center;}table thead tr th{text-align:center;}table thead tr th:nth-child(1){width:24rem;}table thead tr th:nth-child(2){width:24rem;}');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            关键字回复管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 基本管理</a></li>
            <li class="active">关键字管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="<?= Url::toRoute(['keyword/create'])?>"><button type="button" class="btn bg-purple">增加关键字</button></a></h3>
                    </div>
                    <div class="box-body">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>关键字</th>
                                <th>回复方式</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php foreach($data as $val) { ?>
                                <tr>
                                    <td><?= $val->keyword;?></td>
                                    <td><?php if($val->status == 1){echo '文本回复';}elseif($val->status == 2){echo '图文回复';}else{echo '链接回复';}?></td>
                                    <td>
                                        <button type="button" class="btn btn-info reply" idata="<?= $val->id ?>" status="2">图文</button>&nbsp;
                                        <button type="button" class="btn btn-primary reply" idata="<?= $val->id ?>" status="1">文本</button>&nbsp;
                                        <button type="button" class="btn btn-warning reply" idata="<?= $val->id ?>" status="3">连接</button>&nbsp;
                                        <a href="<?= Url::toRoute(['/weixin/keyword/update','id'=>$val->id])?>"><button type="button" class="btn btn-success">编辑</button></a>&nbsp;
                                        <button type="button" class="btn btn-danger replydel" idata="<?= $val->id ?>">删除</button>&nbsp;
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <?= LinkPager::widget(['pagination' => $pagination]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

$keycreateid = Yii::$app->session->getFlash('keycreateid') ? 1 : 0 ;
$keyupdateid = Yii::$app->session->getFlash('keyupdateid') ? 1 : 0 ;
$url = \yii\helpers\Url::toRoute('/weixin/keyword/upreply');
$delurl = \yii\helpers\Url::toRoute('/weixin/keyword/delreply');

$script = <<<JS

if($keycreateid != 0){
    layer.alert("添加成功", {icon: 6});
}

if($keyupdateid != 0){
    layer.alert("编辑成功", {icon: 6});
}

$('.reply').on('click',function(){

    var thisobj = $(this);
    var id = thisobj.attr('idata');
    var data = thisobj.attr('status');
    
    if(data == 1){
        var msg = "设置文本回复";
    }else if(data == 2){
        var msg = "设置图文回复";
    }else if(data == 3){
        var msg = "设置链接回复";
    }

    layer.msg(msg, {
      time: 0 //不自动关闭
      ,btn: ['确定', '取消']
      ,yes: function(index){
        layer.close(index);
         $.ajax({
            url: "$url",
            type: 'post',
            data: {'id':id,'data':data},
            success: function (data) {
                if(data.status == 1){
                    thisobj.parent().parent().children('td').eq(1).html('文本回复');
                    //$(this).remove();
                }else if(data.status == 2){
                    thisobj.parent().parent().children('td').eq(1).html('图文回复');
                //$(this).remove();
                }else{
                    thisobj.parent().parent().children('td').eq(1).html('链接回复');
                //$(this).remove();
                }
                layer.msg('修改成功', {icon: 1});
            }
         });
      }
    });
});

$(".replydel").on("click",function(){
    var thisobj = $(this);
    var id = thisobj.attr('idata');
    
    layer.msg("确定删除当前关键词吗？", {
      time: 0 //不自动关闭
      ,btn: ['确定', '取消']
      ,yes: function(index){
        layer.close(index);
         $.ajax({
            url: "$delurl",
            type: 'post',
            data: {'id':id},
            success: function (data) {
                if(data.status){
                    thisobj.parent().parent().remove();
                    layer.msg('删除成功', {icon: 1});
                }
            }
         });
      }
    });
});

JS;

$this->registerJs($script);
?>


