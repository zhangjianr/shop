<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Image;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '轮播广告';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"><?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?></div>
            <div class="box-body">
                <?php Pjax::begin(['id' => 'banner-reloadList'])?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]);
                            }
                        ],
                        'title',
                       [
                            'attribute' => 'created_at',
                           'format' => ['date', 'php: Y-m-d H:i:s'],
                       ],
                        // 'sort',
                        // 'status',
                        // 'is_del',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update} | {delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('编辑', $url);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a("删除", '#', ['onclick' => '
                                        layer.confirm("您确定删除吗?", {
                                            btn: ["确定", "取消"]
                                        }, function(){
                                            $.ajax({
                                                type: "post",
                                                url: "' . $url . '",
                                                data: {id : " ' . $key . '"},
                                                dataType: "json",
                                                success: function (data) {
                                                    if (data.status) {
                                                        layer.msg("操作成功", {icon: 1});
                                                        $.pjax.reload({container:"#banner-reloadList"});
                                                    } else {
                                                        layer.msg("操作失败", {icon: 2});
                                                    }
                                                }
                                            });
                                        });

                                    ']);
                                },
                            ]
                        ],
                    ],
                ]); ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs("
    menuheight('banner-index');
");
?>