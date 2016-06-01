<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Keyword;
use backend\models\Wxmenu;
use common\core\lib\Helper;

/* @var $this yii\web\View */

$this->title = '后台';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('table{text-align:center;}table thead tr th{text-align:center;}');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            自定义菜单管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 基本管理</a></li>
            <li class="active">自定义菜单管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="<?= Url::toRoute(['wxmenu/create'])?>"><button type="button" class="btn bg-purple">新增自定义菜单</button></a>&nbsp;<a href="<?= Url::toRoute(['/weixin/index/menu'])?>"><button type="button" class="btn btn-warning">生成自定义菜单</button></a></h3>
                    </div>
                    <div class="box-body">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>排序</th>
                                <th>点击推送关键字</th>
                                <th>标题</th>
                                <th>级别</th>
                                <th>链接地址</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($data as $val) { ?>
                                <tr>
                                    <td><input class="order" style="width: 2rem;text-align: center;border-radius:1rem;" value="<?= $val->sort ?>" data="<?= $val->id ?>" /></td>
                                    <td><?php if($val->superior == 0 && $val->type == ''){echo '有二级菜单';}elseif ($val->type == 'view'){echo '链接跳转菜单';}else{$keyobj = Keyword::findOne($val->kid);echo $keyobj ? $keyobj->keyword: '关键字以被删除';} ?></td>
                                    <td><?= $val->name ?></td>
                                    <td><?php if($val->superior == 0){echo '一级菜单';}else{$result = Wxmenu::findOne(['id'=>$val->superior]);echo $result? $result->name :'上级菜单被删除';}?></td>
                                    <td><?php if($val->url && $val->type == 'view'){echo $val->url;}elseif($val->superior == 0 && $val->type == ''){echo '有二级菜单';}else{echo '事件推送菜单';}?></td>
                                    <td>
                                        <a href="<?= Url::toRoute(['/weixin/wxmenu/update','id'=>$val->id])?>"><button type="button" class="btn btn-success">编辑</button></a>&nbsp;
                                        <button type="button" class="btn btn-danger menudel" idata="<?= $val->id ?>">删除</button>&nbsp;
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <button type="button" style="margin-top:1rem;" class="btn btn-info menusort">排序</button>
                        <?= LinkPager::widget(['pagination' => $pagination]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

$menuid = Yii::$app->session->getFlash('menuid') ? 1 : 0 ;
$menuupid = Yii::$app->session->getFlash('menuupid') ? 1 : 0 ;
$cremenu = Yii::$app->session->getFlash('cremenu') ? 1 : 0 ;
$delurl = \yii\helpers\Url::toRoute('/weixin/wxmenu/delmenu');
$ordurl = \yii\helpers\Url::toRoute('/weixin/wxmenu/ordmenu');

$script = <<<JS

if($menuid != 0){
    layer.alert("添加成功", {icon: 6});
}

if($menuupid != 0){
    layer.alert("编辑成功", {icon: 6});
}

if($cremenu != 0){
    layer.alert("生成自定义菜单成功", {icon: 6});
}

$(".menudel").on("click",function(){
    var thisobj = $(this);
    var id = thisobj.attr('idata');
    
    layer.msg("确定删除当前回复？", {
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

$(".menusort").on("click",function(){
var str = "";
    $(".order").each(function(){
	str += $(this).val()+",";
	str += $(this).attr('data')+",";
	});
	$.ajax({
	url:"$ordurl",
	type:"post",
	data:{"data":str},
	success: function(data){
		layer.msg('排序完成!',{icon:1,time:1000});
    	}
	})
});

JS;

$this->registerJs($script);
?>
