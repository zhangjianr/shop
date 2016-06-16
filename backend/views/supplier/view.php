<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Image;
use yii\helpers\Url;
use backend\models\forms\SupplierForm;
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
                            'attribute' => 'password_hash',
                            'format' => 'raw',
                            'value' => Html::a('修改', '#', ['data-toggle' => 'modal', 'data-target' => '#updatePass'])
                        ],
                        [
                            'attribute' => 'pass_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
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
                        'company_address'
                    ],
                ]) ?>
                <br>
                <div class="text-left">
                    <?= Html::a('返回列表', Url::toRoute('/supplier/index'), ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render('_modal', [
    'model' => $passModel,
]) ?>
