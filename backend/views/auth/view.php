<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?></h3>
                </div>
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
                        ]
                    ]) ?>
                    <?php $from = ActiveForm::begin() ?>
                    <table class="table table-bordered">
                        <tr>
                            <td><h3>权限设置</h3></td>
                        </tr>
                        <tr>
                            <td>
                                <?php foreach ($nodeList as $node): ?>
                                    <dl>
                                        <dt>
                                            <label class="checkbox-inline"><input class="rules_all"
                                                                                  type="checkbox"><?= $node['name'] ?>
                                            </label>
                                        </dt>
                                        <dd>
                                            <div class="rule_check">
                                                <span class="divsion">&nbsp;&nbsp;</span>
                                                <span class="child_row">
                                                    <?php foreach ($node['child'] as $child): ?>
                                                        <label class="checkbox-inline"><input class="auth_rules"
                                                                                              type="checkbox"
                                                                                              name="rules[]"
                                                                                              value="<?= $child['route'] ?>" <?= array_key_exists($child['route'], $permission) ? "checked" : ""; ?>/><?= $child['name'] ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </span>
                                            </div>
                                        </dd>
                                    </dl>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                    <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'id' => 'permission']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>


<?php
$id = $model->id;
$url = \yii\helpers\Url::toRoute('/auth/permission');
$jumpUrl = \yii\helpers\Url::toRoute(['/auth/index']);
$js = <<<SCRIPT
//权限保存操作
$("#permission").on('click', function (e) {
    e.preventDefault();
    var that = $(this);
    var checkVal = $("input.auth_rules");
    var data = [];
    $.each(checkVal, function (i, item) {
        if ($(item).prop('checked')) {
            data.push($(item).val());
        }
    });

    $.ajax({
        type: "post",
        url: "$url",
        cache: false,
        data: {'id': "$id", 'data': data},
        dataType: "json",
        success: function (data) {
            if (data.status) {
                layer.msg('设置成功', {time: 2000, icon: 6});
                location.href = "$jumpUrl";
            } else {
                layer.msg('设置失败', {time: 2000, icon: 5});
            }
        }
    });
});

$('.rules_all').on('change', function () {
    $(this).closest('dl').find('dd').find('input.auth_rules').prop('checked', this.checked);
});
SCRIPT;

$this->registerJs($js);
?>