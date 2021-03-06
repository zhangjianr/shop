<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?></h3>
                    <?= $this->render('_search', [
                        'model' => $searchModel,
                    ]) ?>
                </div>
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'username',
                            'email:email',
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->status == 10 ? '活跃' : '锁定'; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                                },
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'headerOptions' => ['width' => '150px'],
                                'template' => '{view} {lock}',
                                'buttons' => [
                                    'view' => function ($url) {
                                        return Html::a("查看", $url, ['target' => '_blank', 'class' => 'btn btn-primary']);
                                    },
                                    'lock' => function ($url, $model, $key) {
                                        return Html::a($model['status'] == 10 ? '锁定' : '解锁', '', ['class' => 'btn btn-info lock_user', 'data-id' => $key]);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


<?php
use yii\helpers\Url;

$csrf = Yii::$app->request->csrfToken;
$url = Url::toRoute('/auth/status');
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
                    data: {id : uid, status : isLock, model : 'backend\\\models\\\Admin', _csrf : "$csrf"},
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

        menuheight('auth-index');
SCRIPT;


$this->registerJs($js);
?>