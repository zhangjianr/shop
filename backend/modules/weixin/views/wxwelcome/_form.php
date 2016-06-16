<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Wxreply;
use backend\models\Wxnewreply;
use backend\models\WxReplyMult;



/* @var $this yii\web\View */
/* @var $model backend\models\WxWelcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form form-horizontal">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ],
    ]); ?>

    <?= $form->field($model, 'id')->hiddenInput(['value'=>1])->label(false) ?>

    <?= $form->field($model, 'type')->dropDownList(
        ['1'=>'文本', '2'=>'图文', '3'=>'多图文'],
        [
            'onchange' => '
                var url = "' . Url::toRoute('/weixin/wxwelcome/keyword') . '";
                var id = $(this).val();
                $.post(url, {id : id}, function(data){
                    $("#wxwelcome-kid").html(data);
                })'
        ]) ?>
    <?php if($model->type == 3): ?>
        <?= $form->field($model, 'kid')->dropDownList(ArrayHelper::map(WxReplyMult::find()->all(),'id','keyword')) ?>
    <?php elseif ($model->type == 2):?>
        <?= $form->field($model, 'kid')->dropDownList(ArrayHelper::map(Wxreply::find()->all(),'id','keyword')) ?>
    <?php else: ?>
        <?= $form->field($model, 'kid')->dropDownList(ArrayHelper::map(Wxnewreply::find()->all(),'id','keyword')) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success col-sm-offset-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
