<?php

use yii\helpers\Html;
use backend\models\Image;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\WxReplyMult */

$this->title = '新增多图文';
$this->params['breadcrumbs'][] = ['label' => 'Wx Reply Mults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-6">
        <div class="box">
            <?php Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider ,
                'columns' => [
                    [
                        'attribute' => 'image_id',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]);
                        }
                    ],
                    'keyword',
                    'title',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::button("选择", ['class' => 'btn btn-info select','data'=>$key,'tit'=>$model->title]);
                            },
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php

$script = <<<JS

var strArr = new Array();
$('.box').on('click','tr>td>button.select',function() {
    var title = $(this).attr('tit');
    var id = $(this).attr('data');

    if($.inArray(id,strArr) > -1){
        return false;
    }
    
    if(strArr.length > 6){
        layer.msg('最多只能七条');
        return false;
    }
    
    strArr.push(id);

    $('.newslist').parent().append('<div style="text-align:center;background:gray;margin-top:1rem;">'+ title +'<span style="float:right;margin-right:1rem;font-size:1.5rem;cursor:pointer;" class="delete" data="'+ id +'">&times;</span></div>');
    $('#wxreplymult-mult_ids').val(strArr);

});

$('#list').on('click','div>span.delete',function() {
    var id = $(this).attr('data');
    strArr.splice($.inArray(id,strArr),1);
    $(this).parent().remove();
    $('#wxreplymult-mult_ids').val(strArr);
});

JS;

$this->registerJs($script);
?>
