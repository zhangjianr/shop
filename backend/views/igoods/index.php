<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Image;
use yii\widgets\Pjax;
use common\core\lib\Constants;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\IntegralGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '积分商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?php Pjax::begin(['id' => 'igoods-reloadList'])?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        [
                            'attribute' => 'image_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]);
                            }
                        ],
                        'integral',
                        'number',
                        [
                            'attribute' => 'shelves',
                            'value' => function($model){
                                return Constants::getGoodsStatus($model->shelves);
                            }
                        ],
                        [
                            'attribute' => 'shelves_at',
                            'format' => ['date', 'php: Y-m-d H:i:s'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update} | {list}',
                            'buttons' => [
                                'list' => function($url){
                                    return Html::a('兑换列表', ['/iorder/index']);
                                },
                                'update' => function($url){
                                    return Html::a('编辑', $url);
                                },
//                                'delete' => function ($url, $model, $key) {
//                                    return Html::button("删除", ['class' => 'btn btn-danger', 'onclick' => '
//                                        layer.confirm("您确定删除吗?", {
//                                            btn: ["确定", "取消"]
//                                        }, function(){
//                                            $.ajax({
//                                                type: "post",
//                                                url: "' . $url . '",
//                                                data: {id : " ' . $key . '"},
//                                                dataType: "json",
//                                                success: function (data) {
//                                                    if (data.status) {
//                                                        layer.msg("操作成功", {icon: 1});
//                                                        $.pjax.reload({container:"#igoods-reloadList"});
//                                                    } else {
//                                                        layer.msg("操作失败", {icon: 2});
//                                                    }
//                                                }
//                                            });
//                                        });
//
//                                    ']);
//                                },
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
    menuheight('igoods-index');
");
?>