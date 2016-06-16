<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\ServiceCategory;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\ServiceCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '服务分类';
$this->params['breadcrumbs'][] = $this->title;

$model = new ServiceCategory();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <?= Html::a('添加', '#', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#createCate']) ?></h3>
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?php Pjax::begin(['id' => 'category-reloadList']) ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                        ],
                        'sort',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            //'headerOptions' => ['width' => '150px'],
                            'template' => '{update} {delete} ',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a("编辑", '#', ['class' => 'btn btn-info updateCate', 'data-toggle' => 'modal', 'data-target' => '#updateCate', 'data' => json_encode(ArrayHelper::toArray($model))]);
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
                                                        $.pjax.reload({container:"#category-reloadList"});
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

<?= $this->render('create', ['model' => $model]) ?>
<?= $this->render('update', ['model' => $model]) ?>
<?php
$this->registerJs("
    $('.updateCate').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#update').find('#servicecategory-id').val(data.id);
        $('#update').find('#servicecategory-name').val(data.name);
        $('#update').find('#servicecategory-sort').val(data.sort);
    });
    menuheight('category-index');
");
?>
