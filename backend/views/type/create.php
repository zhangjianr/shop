<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
/* @var $this yii\web\View */
/* @var $model backend\models\ServiceType */

?>

<div class="modal inmodal" id="createType" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="service-type-form form-horizontal">
                        <?php $form = ActiveForm::begin([
                            'id' => 'create',
                            'method' => 'post',
                            'action' => ['/type/create'],
                            'fieldConfig' => [
                                'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                                'labelOptions' => ['class' => 'col-sm-4 control-label'],
                                'inputOptions' => ['class' => 'form-control']
                            ],
                            'enableAjaxValidation' => 'true',
                        ]); ?>
                        <?= $form->field($model, 'service_cid')->dropDownList(
                            ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_ACTIVE]), 'id', 'name'),
                            ['prompt' => '请选择']
                        ) ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'sort')->textInput() ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                            <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

