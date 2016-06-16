<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Image;
/* @var $this yii\web\View */
/* @var $model backend\models\Link */
/* @var $form yii\widgets\ActiveForm */
$model->status = 10;
?>

<div class="link-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>


    <?= $form->field($model, 'image_id')->fileInput() ?>

    <!- 图片显示 -->
    <?php if (!$model->isNewRecord && $model->image_id) : ?>
        <?= Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px",  'class' => 'col-sm-offset-1']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->radioList([10 => '显示', 0 => '隐藏']) ?>

    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('返回列表', ['index'], ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
