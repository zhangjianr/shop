<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Keyword;
use backend\models\Wxmenu;
use common\core\lib\Helper;

/* @var $this yii\web\View */

$this->title = '自定义菜单管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('table{text-align:center;}table thead tr th{text-align:center;}');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><a href="<?= Url::toRoute(['wxmenu/create']) ?>">
                        <button type="button" class="btn bg-purple">新增自定义菜单</button>
                    </a>&nbsp;<a href="<?= Url::toRoute(['/weixin/index/menu']) ?>">
                        <button type="button" class="btn btn-warning">生成自定义菜单</button>
                    </a></h3>
            </div>
            <div class="box-body">

                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>排序</th>
                        <th>标题</th>
                        <th>关键字</th>
                        <th>类型</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($data as $val) { ?>
                        <tr>
                            <td><input class="order" style="width: 2rem;text-align: center;border-radius:1rem;" value="<?= $val['sort'] ?>" data="<?= $val['id'] ?>"/></td>
                            <td align="left"><?php if($val['pid'] != 0){echo '|------';} echo $val['name'] ?> </td>
                            <td><?= $val['keyword'] ?></td>
                            <td><?= $val['type'] == 'click' ? '点击事件' : '跳转事件' ?></td>
                            <td><?= $val['url']  ?></td>

                            <td>
                                <a href="<?= Url::toRoute(['/weixin/wxmenu/update', 'id' => $val['id']]) ?>">
                                    <button type="button" class="btn btn-success">编辑</button>
                                </a>&nbsp;
                                <button type="button" class="btn btn-danger menudel" idata="<?= $val['id'] ?>">删除</button>
                                &nbsp;
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
                <button type="button" style="margin-top:1rem;" class="btn btn-info menusort">排序</button>
            </div>
        </div>
    </div>
</div>


<?php

$menuid = Yii::$app->session->getFlash('menuid') ? 1 : 0;
$menuupid = Yii::$app->session->getFlash('menuupid') ? 1 : 0;
$cremenu = Yii::$app->session->getFlash('cremenu') ? 1 : 0;
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
		location.reload();
    	}
	})
});
menuheight('weixin-wxmenu-index');
JS;

$this->registerJs($script);
?>
