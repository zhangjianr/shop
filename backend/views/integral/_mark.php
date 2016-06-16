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

<div class="modal inmodal" id="markInfo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin([
                        'id' => $model->formName(),
                        'method' => 'post',
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-4 control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ],
                    ]); ?>
                    <?= $form->field($model, 'description')->textarea(['cols' => 10, 'rows' => 8, 'disabled' => true]) ?>
                    <div class="form-group text-center">
                        <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


