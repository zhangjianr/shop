<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/6/1
 * Time: 下午5:56
 * @author wuqi
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="modal inmodal" id="iOrder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin([
                        'id' => $model->formName(),
                        'method' => 'post',
                        'action' => ['/iorder/express'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-4 control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ],
                        'enableAjaxValidation' => true,
                    ]); ?>

                    <?= $form->field($model, 'express_company')->textInput() ?>
                    <?= $form->field($model, 'express_num')->textInput() ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
                        <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                        <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


