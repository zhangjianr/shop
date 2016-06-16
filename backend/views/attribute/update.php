<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\core\lib\Constants;
/* @var $this yii\web\View */
/* @var $model backend\models\Attribute */

$this->title = '修改属性值';
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modal inmodal" id="updateAttri" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="service-attribute-form form-horizontal">
                        <?php $form = ActiveForm::begin([
                            'id' => 'update',
                            'method' => 'post',
                            'action' => ['/attribute/update'],
                            'fieldConfig' => [
                                'template' => '{label}<div class="col-sm-5">{input}{error}</div>',
                                'labelOptions' => ['class' => 'col-sm-4 control-label'],
                                'inputOptions' => ['class' => 'form-control']
                            ],
                            'enableAjaxValidation' => 'true',
                        ]); ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'type')->dropDownList(Constants::getAttriType(), ['prompt' => '请选择']) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                            <?= Html::button('取消', ['type' => "button", 'class' => "btn btn-white col-sm-offset-1", 'data-dismiss' => 'modal']) ?>
                            <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
