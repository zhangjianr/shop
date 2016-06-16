<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\core\lib\Constants;
use backend\models\CompanyReg;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\CompanyRegSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '待审核供应商列表';
$this->params['breadcrumbs'][] = $this->title;
$denyModel = new CompanyReg();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= $this->render('_searchAudit', [
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
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Constants::getAudit($model->status);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'headerOptions' => ['width' => '150px'],
                            'template' => '{view} | {allow} | {deny}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a("查看", ['/supplier/aview', 'id' => $key], ['target' => '_blank']);
                                },
                                'allow' => function ($url, $model, $key) {
                                    return Html::a('通过', '#', ['onclick' => '
                                            layer.confirm("您确定当前供应商通过审核吗？", {
                                                btn: ["确定", "取消"]
                                            }, function(){
                                                $.ajax({
                                                    type: "post",
                                                    url: "' . Url::toRoute('/supplier/status') . '",
                                                    data: {id : "' . $key . '", status : "' . CompanyReg::AUDIT_TRUE . '", pass_at : "' . time() . '", model : "backend\\\models\\\CompanyReg", _csrf : "' . Yii::$app->request->csrfToken . '"},
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data.status) {
                                                            $.pjax.reload({container:"#supplier-reloadList"});
                                                            layer.msg("操作成功", {icon: 1});
                                                        } else {
                                                            layer.msg("操作失败", {icon: 2});
                                                        }
                                                    }
                                                });
                                            });
                                        ']);
                                },
                                'deny' => function ($url, $model, $key) {
                                    return Html::a('拒绝', '#', ['class' => 'denyInfo', 'data-toggle' => 'modal', 'data-target' => '#updateDeny', 'data' => json_encode(ArrayHelper::toArray($model))]);
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

<?= $this->render('_deny', ['model' => $denyModel]) ?>

<?php
$this->registerJs("
    $('.denyInfo').on('click', function (e) {
        e.preventDefault();
        var data = $.parseJSON($(this).attr('data'));
        $('#CompanyReg').find('#companyreg-id').val(data.id);
        $('#CompanyReg').find('#companyreg-deny_info').val(data.deny_info);
    });
    menuheight('supplier-audit');
");
?>

