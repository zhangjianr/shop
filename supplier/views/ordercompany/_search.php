<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use supplier\models\ServiceCategory;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model supplier\models\searchs */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-search text-right">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],
        'fieldConfig' => [
            'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
            'inputOptions' => ['class' => 'form-control','style'=>'width:15rem;']
        ]
    ]); ?>

    <?= $form->field($model, 'order_sn', ['template' => '{label} {input}']) ?>

    <?= $form->field($model, 'status', ['template' => '{input}'])->dropDownList(['0'=>'未处理','10'=>'以处理'],['prompt'=>'状态']) ?>

    <?= $form->field($model, 'cate_id', ['template' => '{input}'])->dropDownList(
        ArrayHelper::map(ServiceCategory::findAll(['status'=>10]),'id' ,'name' ),
        ['prompt'=>'服务分类', 'onchange' => '
            var url = "' . Url::toRoute('/customorder/type') . '";
            var id = $(this).val();
            $.post(url, {id : id}, function(data){
                $("#ordercompanysearch-type_id").html(data);
            })'
        ])?>    

    <?= $form->field($model, 'type_id', ['template' => '{input}'])->dropDownList(['prompt'=>'所属服务']) ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
