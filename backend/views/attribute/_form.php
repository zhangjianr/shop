<?php
//废弃页面
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
use backend\models\ServiceType;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Attribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'cate_id')->dropDownList(
        ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_TRUE]), 'id', 'name'),
        ['prompt' => '请选择', 'onchange' => '
            var url = "' . Url::toRoute('/attribute/childlist') . '";
            var id = $(this).val();
            $.post(url, {id : id}, function(data){
                $("#attribute-type_id").html(data);
            })
        ']
    ); ?>
    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(ServiceType::findAll(['status' => ServiceType::STATUS_TRUE, 'service_cid' => $model->cate_id]), 'id', 'name'),
        ['prompt' => '请选择'])
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
