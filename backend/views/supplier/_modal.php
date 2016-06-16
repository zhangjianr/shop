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

<div class="modal inmodal" id="updatePass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin([
                        'id' => $model->formName(),
                        'method' => 'post',
                        'action' => ['/supplier/updatepass'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-4 control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ],
                    ]); ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                        <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                        <?= $form->field($model, 'id')->hiddenInput(['value' => Yii::$app->request->get('id')])->label(false); ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
