<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
use yii\helpers\Url;
use backend\models\ServiceType;
use common\core\lib\Constants;
/* @var $this yii\web\View */
/* @var $model backend\models\searchs\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}</div>',
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>
    <?= $form->field($model, 'service_cid')->dropDownList(
        ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_ACTIVE]), 'id', 'name'),
        ['prompt' => '请选择', 'onchange' => '
            var url = "' . Url::toRoute('/attribute/childlist') . '";
            var id = $(this).val();
            $.post(url, {id : id}, function(data){
                $("#goodssearch-type_id").html(data);
            })
        ']
    ); ?>
    &nbsp;&nbsp;
    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(ServiceType::findAll(['status' => ServiceType::STATUS_ACTIVE, 'service_cid' => $model->service_cid]), 'id', 'name'),
        ['prompt' => '请选择'])
    ?>
    &nbsp;&nbsp;
    <?= $form->field($model, 'status')->dropDownList(Constants::getGoodsStatus(), ['prompt' => '请选择']) ?>
    &nbsp;&nbsp;
    <?= $form->field($model, 'service_name', ['template' => '{label} {input} ']) ?>
    &nbsp;&nbsp;
    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'is_del') ?>


    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('清空', ['class' => 'btn btn-default']) ?>


    <?php ActiveForm::end(); ?>

</div>
