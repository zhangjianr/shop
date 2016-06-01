<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "查看";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'username',
                                'auth_key',
                                'password_hash',
                                'password_reset_token',
                                'email:email',
                                [                    // the owner name of the model
                                    'attribute' => 'status',
                                    'value' => $model->status == 10 ? '活跃' : '锁定'
                                ],
                                [
                                    'attribute' => 'created_at',
                                    'filter' => false, //不显示搜索框
                                    'format' => ['date', 'php:Y-m-d H:i:s'],
                                ],
                                [
                                    'attribute' => 'updated_at',
                                    'filter' => false, //不显示搜索框
                                    'format' => ['date', 'php:Y-m-d H:i:s'],
                                ],
                            ],
                        ]) ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>