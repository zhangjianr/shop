<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Keyword;
use common\core\lib\Helper;

/* @var $this yii\web\View */

$this->title = '后台';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('table{text-align:center;}table thead tr th{text-align:center;}table thead tr th:nth-child(1){width:30rem;}table thead tr th:nth-child(2){width:30rem;}');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            文本回复管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 基本管理</a></li>
            <li class="active">文本回复管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="<?= Url::toRoute(['wxnewreply/create'])?>"><button type="button" class="btn bg-purple">新增文本回复</button></a></h3>
                    </div>
                    <div class="box-body">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>关键字</th>
                                <th>回复内容</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php foreach($data as $val) { ?>
                                <tr>
                                    <td><?php $keyobj = Keyword::findOne($val->kid);echo $keyobj ? $keyobj->keyword: '关键字以被删除' ?></td>
                                    <td><?= Helper::truncate_utf8_string($val->content,20) ?></td>
                                    <td>
                                        <a href="<?= Url::toRoute(['/weixin/wxnewreply/update','id'=>$val->id])?>"><button type="button" class="btn btn-success">编辑</button></a>&nbsp;
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

$keynewcreateid = Yii::$app->session->getFlash('keynewcreateid') ? 1 : 0 ;
$keynewupdateid = Yii::$app->session->getFlash('keynewupdateid') ? 1 : 0 ;
$delurl = \yii\helpers\Url::toRoute('/weixin/wxnewreply/delnewreply');

$script = <<<JS

if($keynewcreateid != 0){
    layer.alert("添加成功", {icon: 6});
}

if($keynewupdateid != 0){
    layer.alert("编辑成功", {icon: 6});
}

$(".replydel").on("click",function(){
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

JS;

$this->registerJs($script);
?>



