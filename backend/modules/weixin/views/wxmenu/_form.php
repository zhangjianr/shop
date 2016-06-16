<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\models\Keyword;
use backend\models\Wxmenu;

?>

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
                            <?= $form->field($model, 'sort')->textInput(['max'=>2,'style'=>'width:5rem;']) ?>
                            <?= $form->field($model, 'pid')->dropdownList(
                                Wxmenu::find()->where(['pid'=>0,'type'=>''])->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'一级菜单','style'=>'width:20rem;'])?>
                            <?= $form->field($model, 'type')->dropdownList(['click'=>'点击','view'=>'链接'],['prompt'=>'有二级菜单','style'=>'width:20rem;']) ?>
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'标题']) ?>
                            <?= $form->field($model, 'keyword')->textInput(['placeholder'=>'关键词']) ?>
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
<?php
$yijinum = Yii::$app->session->getFlash('yijinum') ? 1 : 0 ;
$erjinum = Yii::$app->session->getFlash('erjinum') ? 1 : 0 ;

$script = <<<JS

if($yijinum != 0){
    layer.alert("最多只能添加三条一级菜单 已达上限", {icon: 5});
}

if($erjinum != 0){
    layer.alert("每个一级菜单下只能有五条二级菜单 此一级菜单已达上限", {icon: 5});
}

$('#wxmenu-type').change(function(){
var sta = $('#wxmenu-type').val();
    if(sta == 'click'){
        $('#wxmenu-keyword').parent().parent().show();
        $('#wxmenu-url').parent().parent().hide();
    }else if (sta == 'view'){
        $('#wxmenu-url').parent().parent().show();
        $('#wxmenu-keyword').parent().parent().hide();
    }else {
        $('#wxmenu-keyword').parent().parent().hide();
        $('#wxmenu-url').parent().parent().hide();
    }
})

JS;

$this->registerJs($script);
