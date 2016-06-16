<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Image;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\IntegralGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integral-goods-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_id')->fileInput() ?>

    <!- 图片显示 -->
    <?php if (!$model->isNewRecord && $model->image_id) : ?>
        <?= Html::img(Image::getImage($model->image_id), ['width' => "100px", 'height' => "100px"]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'integral')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'shelves')->checkboxList([10 => '上架'])->label('是否上架') ?>

    <div class="form-group text-center col-sm-6">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
