<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ServiceCategory;
use backend\models\ServiceType;
use backend\models\Image;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?></h3>
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?php Pjax::begin(['id' => 'goods-reloadList'])?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'service_name',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]);
                            }
                        ],
                        'price',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return $model->status == $model::STATUS_UP_SHELVES ? "上架" : "下架";
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                        ],
                        // 'attri_id',
                        // 'detail:ntext',
                        // 'created_at',
                        // 'updated_at',
                        // 'is_del',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                           // 'headerOptions' => ['width' => '200px'],
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'view' => function ($url) {
                                    return Html::a("查看", $url, ['target' => '_blank', 'class' => 'btn btn-primary']);
                                },
                                'update' => function ($url) {
                                    return Html::a("编辑", $url, ['class' => 'btn btn-warning']);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::button("删除", ['class' => 'btn btn-danger', 'onclick' => '
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
                                                        $.pjax.reload({container:"#goods-reloadList"});
                                                    } else {
                                                        layer.msg("操作失败", {icon: 2});
                                                    }
                                                }
                                            });
                                        });

                                    ']);
                                },

                            ],

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
    menuheight('goods-index');
");
?>