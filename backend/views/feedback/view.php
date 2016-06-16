<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = "供应商反馈详情";
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => function ($attribute, $index, $widget) {
                        if ($attribute['attribute'] == 'reply_content') {
                            return "<tr><td colspan='2'>".Html::textarea('reply_content', $attribute['value'], ['cols' => 80, 'rows' => 10, 'id' => 'area'])."</td></tr>";
                        } else {
                            return  "<tr><th>".$attribute['label']."</th><td>".$attribute['value']."</td></tr>";
                        }
                    },
                    'attributes' => [
                        'id',
                        'companyReg.company_name',
                        'content:ntext',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php: Y-m-d H:i:s'],
                        ],
                        [
                            'visible' => $model->status == $model::STATUS_TRUE ? true : false,
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php: Y-m-d H:i:s'],
                        ],
                        [
                            'attribute' => 'reply_content',
                        ]
                    ],
                ]) ?>
                <br>
                <div class="text-left">
                    <?= Html::a('回复', '#', ['class' => 'btn btn-primary', 'onclick' => '
                            var content = $("#area").val();
                            $.ajax({
                                type: "post",
                                url: "' . Url::toRoute(['/feedback/update']) . '",
                                data: {id : " ' . Yii::$app->request->get('id') . '", content : content},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status) {
                                        layer.msg("反馈成功", {icon: 1});
                                        location.href = data.url;
                                    } else {
                                        layer.msg("反馈失败", {icon: 2});
                                    }
                                }
                            });
                    ']) ?>
                    <?= Html::a('返回列表', Url::toRoute('/feedback/index'), ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
