<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Wxreply;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\WxReplyMultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '多图文列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <p>
                    <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        //'id',
                        'keyword',
                        [
                            'attribute' => 'mult_ids',
                            'format' => 'raw',
                            'value' => function($model){
                                $data = Wxreply::keyname($model->mult_ids);
                                $replyname = '';
                                foreach ($data as $val){
                                    $replyname .= $val->title.'<br>';
                                }
                                return $replyname;
                            }
                        ],
                        //'keyword_type',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update} {delete} ',
                            'buttons' => [
                                'update' => function($url){
                                    return Html::a('修改',$url,['class' => 'btn btn-success']);
                                },
                                'delete' => function ($url,$model,$key) {
                                    return Html::Button('删除', ['class' => 'btn btn-danger delete','data' => $key]);
                                },
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php

$createmultid = Yii::$app->session->getFlash('createmultid') ? 1 : 0;
$updatemultid = Yii::$app->session->getFlash('updatemultid') ? 1 : 0;
$delurl = \yii\helpers\Url::toRoute('/weixin/wxreplymult/delete');

$script = <<<JS

if($createmultid != 0){
    layer.alert("添加成功", {icon: 6});
}

if($updatemultid != 0){
    layer.alert("编辑成功", {icon: 6});
}

$(".delete").on("click",function(){
    var thisobj = $(this);
    var id = thisobj.attr('data');
    
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
menuheight('weixin-wxreplymult-index');
JS;

$this->registerJs($script);
?>


