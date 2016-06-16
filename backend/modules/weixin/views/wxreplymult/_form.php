<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Wxreply;

/* @var $this yii\web\View */
/* @var $model backend\models\WxReplyMult */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="integral-goods-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ],
    ]); ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mult_ids')->hiddenInput()->label(false) ?>
    <div style="text-align: center" id="list">
        <label class="newslist">图文列表</label>
        <?php $arr = Wxreply::keyname($model->mult_ids); foreach ($arr as $val) {
            ?>
            <div style="text-align:center;background:gray;margin-top:1rem;"><?= $val->title ?><span style="float:right;margin-right:1rem;font-size:1.5rem;cursor:pointer;" class="delete" data="<?= $val->id ?>">&times;</span></div>
            <?php
        }?>
    </div>

    <div class="form-group text-center col-sm-6">
        <?= Html::resetButton('清空', ['class' =>  'btn btn-default' ]) ?>

        <?= Html::submitButton($model->isNewRecord ? '确定' : '确定', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
