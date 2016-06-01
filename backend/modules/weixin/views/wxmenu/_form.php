<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\Keyword;
use backend\models\Wxmenu;

$this->title = '添加自定义菜单';
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= Html::encode($this->title) ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-weixin text-green"></i> 微信</a></li>
                <li><a href="#">系统管理</a></li>
                <li class="active">公众号管理</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-11">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加自定义菜单</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal'],
                            'fieldConfig'=>[
                                'template'=>'<div class="form-group">{label}<div class="col-sm-9">{input}{error}</div></div>',
                                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                                'inputOptions' => ['class' => 'form-control input-lg']
                            ]]);?>
                        <div class="box-body">
                            <button type="button" style="margin-top:1rem;" class="btn btn-info yj">一级</button>
                            <button type="button" style="margin-top:1rem;" class="btn btn-info ej">二级</button>
                            <button type="button" style="margin-top:1rem;" class="btn btn-info yec">有二级菜单</button>
                            <button type="button" style="margin-top:1rem;" class="btn btn-info wec">无二级菜单</button>
                            <button type="button" style="margin-top:1rem;" class="btn btn-info djts">点击推送</button>
                            <button type="button" style="margin-top:1rem;" class="btn btn-info ljtz">链接跳转</button>
                            <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
                            <?= $form->field($model, 'superior')->dropdownList(
                                Wxmenu::find()->where(['superior'=>0,'type'=>''])->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'请选择一级菜单','style'=>'width:20rem;'])?>
                            <?= $form->field($model, 'kid')->dropdownList(
                                Keyword::find()->select(['keyword', 'id'])->indexBy('id')->column(),['prompt'=>'请选择点击推送的关键词','style'=>'width:20rem;'])?>
                            <?= $form->field($model, 'sort')->textInput(['max'=>2,'style'=>'width:5rem;']) ?>
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'标题']) ?>
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder'=>'链接地址']) ?>
                        </div>
                        <div class="box-footer">
                            <?= Html::resetButton('清除', ['class'=>'btn btn-default']) ?>
                            <?= Html::submitButton('提交', ['class' => 'btn btn-info pull-right']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
$yijinum = Yii::$app->session->getFlash('yijinum') ? 1 : 0 ;
$erjinum = Yii::$app->session->getFlash('erjinum') ? 1 : 0 ;
$type = $model->type == ''? 1 : 2 ;
$ctype = $model->type == 'click'? 1 : 2 ;
$vtype = $model->type == 'view'? 1 : 2 ;
$superior = $model->superior ? $model->superior: -1;
$superiors = $model->superior == 0 ? 1: 2;
$script = <<<JS

if($yijinum != 0){
    layer.alert("最多只能添加三条一级菜单 已达上限", {icon: 5});
}

if($erjinum != 0){
    layer.alert("每个一级菜单下只能有五条二级菜单 此一级菜单已达上限", {icon: 5});
}


$('.yec').hide();
$('.wec').hide();
$('.djts').hide();
$('.ljtz').hide();
$('.yj').on('click',function(){
    $('.yec').show();
    $('.wec').show();
    $('.djts').hide();
    $('.ljtz').hide();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().hide();
});

$('.ej').on('click',function(){
    $('.yec').hide();
    $('.wec').hide();
    $('.djts').show();
    $('.ljtz').show();
    $('#wxmenu-superior').parent().parent().show();
});

$('.yec').on('click',function(){
    $('#wxmenu-type').val('');
    $('.djts').hide();
    $('.ljtz').hide();
    $('#wxmenu-url').parent().parent().hide();
    $('#wxmenu-kid').parent().parent().hide();
});

$('.wec').on('click',function(){
    $('.djts').show();
    $('.ljtz').show();
});

$('.djts').on('click',function(){
    $('#wxmenu-url').parent().parent().hide();
    $('#wxmenu-kid').parent().parent().show();
    $('#wxmenu-type').val('click');
});

$('.ljtz').on('click',function(){
    $('#wxmenu-kid').parent().parent().hide();
    $('#wxmenu-url').parent().parent().show();
    $('#wxmenu-type').val('view');
});

if($superiors == 1 && "$type" == 1){
    $('.yec').show();
    $('.wec').show();
    $('.djts').hide();
    $('.ljtz').hide();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().hide();
    $('#wxmenu-kid').parent().parent().hide();
    $('#wxmenu-url').parent().parent().hide();
}
if($superiors == 1 && $ctype == 1){
    $('.yec').show();
    $('.wec').show();
    $('.djts').hide();
    $('.ljtz').hide();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().hide();
    $('#wxmenu-url').parent().parent().hide();
    $('#wxmenu-kid').parent().parent().show();
}

if($superiors == 1 && $vtype == 1){
    $('.yec').show();
    $('.wec').show();
    $('.djts').hide();
    $('.ljtz').hide();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().hide();
    $('#wxmenu-kid').parent().parent().hide();
    $('#wxmenu-url').parent().parent().show();
}

if($superior > 0 && $ctype == 1){
    $('.yec').show();
    $('.wec').show();
    $('.djts').show();
    $('.ljtz').show();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().show();
    $('#wxmenu-url').parent().parent().hide();
}

if($superior > 0 && $vtype == 1){
    $('.yec').show();
    $('.wec').show();
    $('.djts').show();
    $('.ljtz').show();
    $('#wxmenu-superior option').first().val(0);
    $('#wxmenu-superior').parent().parent().show();
    $('#wxmenu-kid').parent().parent().hide();
    $('#wxmenu-url').parent().parent().show();
}

JS;

$this->registerJs($script);
