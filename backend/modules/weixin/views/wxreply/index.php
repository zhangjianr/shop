<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\Image;
use yii\widgets\LinkPager;
use backend\models\Keyword;
use common\core\lib\Helper;

/* @var $this yii\web\View */

$this->title = '图文回复管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('table{text-align:center;}table thead tr th{text-align:center;}');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><a href="<?= Url::toRoute(['wxreply/create']) ?>">
                        <button type="button" class="btn bg-purple">新增图文回复</button>
                    </a></h3>
            </div>
            <div class="box-body">

                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>图片</th>
                        <th>关键字</th>
                        <th>标题</th>
                        <th>简介</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php foreach ($data as $val) { ?>
                        <tr>
                            <td><?= Html::img(Image::getImage($val->image_id), ['width' => "30px", 'height' => "30px"]);?></td>
                            <td><?= $val->keyword ?></td>
                            <td><?= $val->title ?></td>
                            <td><?= $val->description ?></td>
                            <td><?= $val->url ?></td>
                            <td>
                                <a href="<?= Url::toRoute(['/weixin/wxreply/update', 'id' => $val->id]) ?>">
                                    <button type="button" class="btn btn-success">编辑</button>
                                </a>&nbsp;
                                <button type="button" class="btn btn-danger replydel" idata="<?= $val->id ?>">删除
                                </button>
                                &nbsp;
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


<?php

$keycreateid = Yii::$app->session->getFlash('keycreateid') ? 1 : 0;
$keyupdateid = Yii::$app->session->getFlash('keyupdateid') ? 1 : 0;
$delurl = \yii\helpers\Url::toRoute('/weixin/wxreply/delreply');
$ordurl = \yii\helpers\Url::toRoute('/weixin/wxreply/ordreply');

$script = <<<JS

if($keycreateid != 0){
    layer.alert("添加成功", {icon: 6});
}

if($keyupdateid != 0){
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
menuheight('weixin-wxreply-index');
JS;

$this->registerJs($script);
?>
