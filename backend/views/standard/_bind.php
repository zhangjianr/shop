<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/6/1
 * Time: 下午5:56
 * @author wuqi
 */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
use backend\models\CompanyReg;
use yii\widgets\Pjax;

?>

    <div class="modal inmodal" id="sendBind" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <?php Pjax::begin(['id' => 'ocompany-list']) ?>
                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $bindProvider,
                        'summary' => "<br>",
                        'columns' => [
                            [
                                'attribute' => 'company_id',
                                'value' => function ($model) {
                                    return CompanyReg::findOne($model->company_id)->company_name;
                                }
                            ],
                            [
                                'attribute' => 'create_at',
                                'format' => ['date', 'php:Y-m-d H:i:s']
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => "{bind}",
                                'buttons' => [
                                    'bind' => function ($url, $model, $key) {
                                        return Html::button('解绑', ['class' => 'btn btn-primary', 'onclick' => '
                                            layer.confirm("您确定解除绑定当前供应商吗?", {
                                                btn: ["确定", "取消"]
                                            }, function(){
                                                 var id = "' . $key . '";
                                                 var url = "' . Url::toRoute('/ocompany/delete') . '";
                                                 $.post(url, {id : id}, function(data){
                                                    if(data.status){
                                                        $.pjax.reload({container:"#ocompany-list"});
                                                         layer.msg("解绑成功", {icon: 1});
                                                    }
                                                })
                                            });
                                        ']);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                    <div class="form-horizontal">
                        <?php $form = ActiveForm::begin([
                            'id' => $model->formName(),
                            'action' => Url::toRoute('/ocompany/create'),
                            'fieldConfig' => [
                                'template' => '{label}<div class="col-sm-8">{input}{error}</div>',
                                'inputOptions' => ['class' => 'form-control'],
                                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                            ]
                        ]); ?>

                        <?= $form->field($model, 'cate_id')->dropDownList(
                            ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_ACTIVE]), 'id', 'name'),
                            ['prompt' => '请选择', 'onchange' => '
                                    var url = "' . Url::toRoute('/standard/childlist') . '";
                                    var id = $(this).val();
                                    $.post(url, {id : id}, function(data){
                                        $("#ordercompany-company_id").html(data);
                                    })
                             ']); ?>

                        <?= $form->field($model, 'company_id')->dropDownList(
                            ArrayHelper::map(CompanyReg::findAll(['status' => CompanyReg::AUDIT_TRUE, 'cate_id' => $model->cate_id]), 'id', 'name'),
                            ['prompt' => '请选择'])
                        ?>

                        <?= $form->field($model, 'order_id')->hiddenInput(['id' => 'bid'])->label(false) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('绑定', ['class' => 'btn btn-primary']) ?>
                            <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$csrf = Yii::$app->request->csrfToken;
$url = Url::toRoute('/standard/bind');
$js = <<<SCRIPT
    $('form#status').on('beforeSubmit', function(){
        var currntVal = $(this).html();
        var that = $(this);
        var status = $(that).find('select').val();
        var id = $(that).find('#sid').val();
        $.ajax({
            type: 'post',
            url: "$url",
            data: {id : id, status : status, model : 'backend\\\models\\\CompanyReg', _csrf : "$csrf"},
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    layer.msg('操作成功', {icon: 1});
                    window.location.href = data.url;
                } else {
                    layer.msg('操作失败', {icon: 2});
                }
            }
        });
        return false;
    });
SCRIPT;

$this->registerJs($js);

?>