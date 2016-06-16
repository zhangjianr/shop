<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\core\lib\Constants;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\CompanyRegSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?= $this->render('_search', [
                        'model' => $searchModel,
                    ]) ?>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(['id' => 'supplier-reloadList']) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'username',
                            'company_name',
                            'company_tel',
                            'contact_name',
                            [
                                'attribute' => 'login_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'headerOptions' => ['width' => '150px'],
                                'template' => '{view} | {delete} | {lock}',
                                'buttons' => [
                                    'view' => function ($url) {
                                        return Html::a("查看", $url, ['target' => '_blank']);
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
                                                        $.pjax.reload({container:"#supplier-reloadList"});
                                                    } else {
                                                        layer.msg("操作失败", {icon: 2});
                                                    }
                                                }
                                            });
                                        });

                                    ']);
                                    },
                                    'lock' => function ($url, $model, $key) {
                                        return Html::a($model['is_lock'] == 0 ? '锁定' : '解锁', '', ['onclick' => '
                                            var currntVal = $(this).html();
                                            var that = $(this);
                                            var lockInfo = ["锁定", "解锁"];
                                            layer.confirm("您确定" + currntVal + "当前供应商吗？", {
                                                btn: ["确定", "取消"]
                                            }, function(){
                                                var isLock = (currntVal == lockInfo[1]) ? 0 : 10;
                                                $.ajax({
                                                    type: "post",
                                                    url: "' . Url::toRoute('/supplier/status') . '",
                                                    data: {id :"'.$key.'", is_lock : isLock, model : "backend\\\models\\\CompanyReg", _csrf : "' . Yii::$app->request->csrfToken . '"},
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data.status) {
                                                            $.pjax.reload({container:"#supplier-reloadList"});
                                                            layer.msg(currntVal + "操作成功", {icon: 1});
                                                        } else {
                                                            layer.msg(currntVal + "操作失败", {icon: 2});
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

    menuheight('supplier-index');
");
?>
