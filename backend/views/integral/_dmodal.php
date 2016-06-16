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
<div class="modal inmodal" id="deal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin([
                        'id' => $model->formName(),
                        'method' => 'post',
                        'action' => ['/integral/person'],
                        'fieldConfig' => [
                            'template' => '<div class="col-sm-3 col-sm-offset-4">{input}{error}</div>{label}',
                            'labelOptions' => ['class' => 'col-sm-2'],
                            'inputOptions' => ['class' => 'form-control']
                        ],
                        'enableAjaxValidation' => true,
                    ]); ?>
                    <div class="form-group field-person-integral validating text-center">
                        <div>
                            积分操作
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-4">为<span id="personName"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-4">
                            <?= Html::radioList('op',[1] ,[1 => '增加', 2 => '减少']) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'integral')->textInput()->label('积分') ?>

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

