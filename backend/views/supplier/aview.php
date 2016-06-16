<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Image;
use yii\helpers\Url;
use backend\models\forms\SupplierForm;
use backend\models\CompanyReg;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReg */

$this->title = "供应商查看";
$this->params['breadcrumbs'][] = ['label' => 'Company Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$passModel = new SupplierForm();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'company_name',
                        'username',
                        'company_tel',
                        'contact_name',

                        [
                            'visible' => $model->credit ? true : false,
                            'attribute' => 'credit_num',
                        ],
                        [
                            'visible' => $model->credit ? true : false,
                            'attribute' => 'credit',
                            'format' => 'raw',
                            'label' => '照片',
                            'value' => Html::img(Image::getImage($model->credit), ['width' => "100px", 'height' => "100px"])
                        ],
                        [
                            'visible' => $model->credit ? true : false,
                            'attribute' => 'organization_num',
                        ],
                        [
                            'visible' => $model->organization ? true : false,
                            'attribute' => 'organization',
                            'format' => 'raw',
                            'label' => '照片',
                            'value' => Html::img(Image::getImage($model->organization), ['width' => "100px", 'height' => "100px"])
                        ],
                        [
                            'visible' => $model->credit ? true : false,
                            'attribute' => 'tax_num',
                        ],
                        [
                            'visible' => $model->tax ? true : false,
                            'attribute' => 'tax',
                            'format' => 'raw',
                            'label' => '照片',
                            'value' => Html::img(Image::getImage($model->tax), ['width' => "100px", 'height' => "100px"])
                        ],
                        [
                            'visible' => $model->credit ? true : false,
                            'attribute' => 'license_num',
                        ],
                        [
                            'visible' => $model->license ? true : false,
                            'attribute' => 'license',
                            'format' => 'raw',
                            'label' => '照片',
                            'value' => Html::img(Image::getImage($model->license), ['width' => "100px", 'height' => "100px"])
                        ],
                        'industry',
                        'introduct:ntext',
                        'company_address',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                    ],
                ]) ?>
                <br>
                <div class="text-left">
                    <?= Html::a('通过', '#', ['class' => 'btn btn-primary','onclick' => '
                                            layer.confirm("您确定当前供应商通过审核吗？", {
                                                btn: ["确定", "取消"]
                                            }, function(){
                                                $.ajax({
                                                    type: "post",
                                                    url: "' . Url::toRoute('/supplier/status') . '",
                                                    data: {id : "' . Yii::$app->request->get('id') . '", status : "' . CompanyReg::AUDIT_TRUE . '", model : "backend\\\models\\\CompanyReg", _csrf : "' . Yii::$app->request->csrfToken . '"},
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data.status) {
                                                            layer.msg("操作成功", {icon: 1});
                                                        } else {
                                                            layer.msg("操作失败", {icon: 2});
                                                        }
                                                    }
                                                });
                                            });
                                        ']); ?>
                    <?= Html::a('拒绝', '#', ['class' => 'btn btn-info', 'onclick' => '
                                            layer.confirm("您确定当前供应商审核拒绝吗？", {
                                                btn: ["确定", "取消"]
                                            }, function(){
                                                $.ajax({
                                                    type: "post",
                                                    url: "' . Url::toRoute('/supplier/status') . '",
                                                    data: {id : "' . Yii::$app->request->get('id') . '", status : "' . CompanyReg::AUDIT_NOPASS . '", model : "backend\\\models\\\CompanyReg", _csrf : "' . Yii::$app->request->csrfToken . '"},
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data.status) {
                                                            layer.msg("操作成功", {icon: 1});
                                                        } else {
                                                            layer.msg("操作失败", {icon: 2});
                                                        }
                                                    }
                                                });
                                            });
                                        ']); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render('_modal', [
    'model' => $passModel,
]) ?>
