<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Image;
use backend\models\Person;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "查看";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$person = Person::findOne(Yii::$app->request->get('id'));
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
                        [
                            'attribute' => 'id',
                            'label' => '图像',
                            'format' => 'raw',
                            'value' => Html::img(Image::getImage($person->image_id), ['width' => "100px", 'height' => "100px"])
                        ],
                        'mobile',
                        'email',
                        [
                            'attribute' => 'id',
                            'label' => '用户昵称',
                            'value' => $person->name,
                        ],
                        [
                            'attribute' =>'password_hash',
                            'label' => '密码',
                            'format' => 'raw',
                            'value' => Html::a(' 修改', '#')
                        ],
                        [
                            'attribute' => 'id',
                            'label' => '性别',
                            'value' => $person->sex == 1 ? '男' : '女',
                        ],
                        [
                            'attribute' => 'id',
                            'label' => '积分',
                            'format' => 'raw',
                            'value' => $person->integral . Html::a(' 查看', '#'),
                        ],
                        [
                            'attribute' => 'id',
                            'label' => '优惠券',
                            'format' => 'raw',
                            'value' => 10 . Html::a(' 查看', '#'),
                        ],
                        [
                            'attribute' => 'id',
                            'label' => '订单数',
                            'format' => 'raw',
                            'value' => Html::a(' 查看', '#'),
                        ],
                        [
                            'attribute' => 'id',
                            'label' => '地址',
                            'format' => 'raw',
                            'value' => Html::a('地址列表', '#'),
                        ],

                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
