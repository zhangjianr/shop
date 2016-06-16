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
use common\core\lib\Constants;

?>
    <div class="modal inmodal" id="sendStatus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                    <div class="form-horizontal">
                        <?php $form = ActiveForm::begin([
                            'id' => $model->formName(),
                            'action' => Url::toRoute('/standard/status'),
                            'fieldConfig' => [
                                'template' => '<div class="col-sm-offset-3 col-sm-6">{input}{error}</div>',
                                'inputOptions' => ['class' => 'form-control']
                            ]
                        ]); ?>
                        <?= $form->field($model, 'order_status')->dropDownList(Constants::getOrderStatus(), ['class' => 'form-control', 'prompt' => '请选择', 'onchange' => '
                                        var val = $(this).val();
                                        $("#orderFail").removeClass("show").addClass("hide");
                                        if(val == 2) {
                                            $("#orderFail").removeClass("hide").addClass("show");
                                        }
                                '])->label(false) ?>

                        <?= $form->field($model, 'order_fail')->textarea(['class' => 'form-control hide', 'placeholder' => '订单失败原因', 'rows' => 8, 'id' => 'orderFail'])->label(false) ?>

                        <div class="form-group text-center">
                            <?= $form->field($model, 'sid')->hiddenInput(['id' => 'sid'])->label(false) ?>
                            <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
                            <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

