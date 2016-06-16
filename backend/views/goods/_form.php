<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\ServiceCategory;
use backend\models\ServiceType;
use backend\models\Image;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'service_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_id')->fileInput() ?>

    <!- 图片显示 -->
    <?php if (!$model->isNewRecord && $model->image_id) : ?>
        <?= Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]) ?>
    <?php endif; ?>
    <?= $form->field($model, 'service_cid')->dropDownList(
        ArrayHelper::map(ServiceCategory::findAll(['status' => ServiceCategory::STATUS_ACTIVE]), 'id', 'name'),
        ['prompt' => '请选择', 'onchange' => '
            var url = "' . Url::toRoute('/goods/childlist') . '";
            var id = $(this).val();
            $.post(url, {id : id}, function(data){
                $("#goods-type_id").html(data);
            })
        ']
    ); ?>
    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(ServiceType::findAll(['status' => ServiceType::STATUS_ACTIVE, 'service_cid' => $model->service_cid]), 'id', 'name'),
        ['prompt' => '请选择', 'onchange' => '
            var url = "' . Url::toRoute('/goods/attr') . '";
            var id = $(this).val();
            $.post(url, {id : id}, function(data){
                $("#goods-attribute").html(data);
            })
        '])
    ?>

    <?= Html::a('添加属性', Url::toRoute('/attribute/create'), ['class' => 'btn btn-primary col-sm-offset-1', 'target' => '_blank']) ?>

    <?= Html::tag('span', '刷新', ['class' => 'fa fa-refresh text-green', 'onclick' => '
        $("#goods-type_id").trigger("onchange");
    ']); ?>
    <br/>
    <table class="table table-striped table-bordered" id="goods-attribute"></table>

    <?= $form->field($model, 'detail')->widget('cliff363825\kindeditor\KindEditorWidget', ['clientOptions' => [
        //'langType' => 'zh_CN',
        'items' => [
            'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
            'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
            'anchor', 'link', 'unlink', '|', 'about'
        ],
        'uploadJson' => Url::to(['/goods/Kupload']),
    ]]) ?>
    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>