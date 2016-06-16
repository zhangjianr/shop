<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员列表';
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
                    <?php Pjax::begin(['id' => 'user-reload']) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            // ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'mobile',
                            'person.name',
                            'person.integral',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'attribute' => 'openid',
                                'label' => '注册类型',
                                'value' => function ($model) {
                                    return $model->openid ? '微信' : '手机';
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->status == 10 ? '可用' : '不可用'; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                // 'headerOptions' => ['width' => '150px'],
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
                                                        $.pjax.reload({container:"#user-reload"});
                                                    } else {
                                                        layer.msg("操作失败", {icon: 2});
                                                    }
                                                }
                                            });
                                        });
                                    ']);
                                    },
                                    'lock' => function ($url, $model, $key) {
                                        return Html::a($model['status'] == 10 ? '锁定' : '解锁', '', ['class' => 'lock_user', 'data-id' => $key]);
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
use  yii\helpers\Url;

$csrf = Yii::$app->request->csrfToken;
$url = Url::toRoute('/user/status');
$js = <<<SCRIPT
    $(".lock_user").on('click', function (e) {
            e.preventDefault();
            var currntVal = $(this).html();
            var that = $(this);
            var lockInfo = ["锁定", "解锁"];
            layer.confirm('您确定' + currntVal + '当前用户吗？', {
                btn: ['确定','取消']
            }, function(){
                var isLock = (currntVal == lockInfo[1]) ? 10 : 0;
                var uid = that.attr('data-id');
                $.ajax({
                    type: 'post',
                    url: "$url",
                    data: {id : uid, status : isLock, model : 'common\\\models\\\User', _csrf : "$csrf"},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status) {
                            var index = isLock ? 0 : 1;
                            that.html(lockInfo[index]);
                            layer.msg(lockInfo[isLock/10] + '操作成功', {icon: 1});
                            window.location.href = data.url;
                        } else {
                            layer.msg(lockInfo[isLock/10] + '操作失败', {icon: 2});
                        }
                    }
                });
            });
        });
        menuheight('user-index');
SCRIPT;


$this->registerJs($js);
?>
