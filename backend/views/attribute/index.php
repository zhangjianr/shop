<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ServiceCategory;
use backend\models\ServiceType;
use yii\widgets\Pjax;
use common\core\lib\Constants;
use yii\helpers\ArrayHelper;
use backend\models\Attribute;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '类型属性';
$this->params['breadcrumbs'][] = $this->title;
$model = new Attribute();
?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?= Html::a('添加', '#', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#createAttri']) ?></h3>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(['id' => 'attri-reload']) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'name',
                            [
                                'attribute' => 'type',
                                'value' => function ($model) {
                                    return Constants::getAttriType($model->type);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                //'headerOptions' => ['width' => '200px'],
                                'template' => '{update} | {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::a("编辑", '#', ['class' => 'updateAttri', 'data-toggle' => 'modal', 'data-target' => '#updateAttri', 'data' => json_encode(ArrayHelper::toArray($model))]);
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
                                                        $.pjax.reload({container:"#attri-reload"});
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

<?= $this->render('update', ['model' => $model]) ?>
<?= $this->render('create', ['model' => $model]) ?>

<?php
$this->registerJs("
    $('.updateAttri').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#update').find('#attribute-id').val(data.id);
        $('#update').find('#attribute-name').val(data.name);
        $('#update').find('#attribute-type').val(data.type);
    });
    menuheight('attribute-index');
");
?>