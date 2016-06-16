<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\IntegralGoods */

$this->title = '积分规则';
$this->params['breadcrumbs'][] = ['label' => 'Integral Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="integral-goods-form form-horizontal">

                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-3">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                            'inputOptions' => ['class' => 'form-control']
                        ]
                    ]); ?>

                    <?= $form->field($model, 'integral_rule')->widget('cliff363825\kindeditor\KindEditorWidget', ['clientOptions' => [
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
                        'uploadJson' => Url::to(['/igoods/Kupload']),
                    ]]) ?>

                    <div class="form-group text-center col-sm-6">
                        <?= Html::submitButton('保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a('返回列表', '#', ['class' =>  'btn btn-default' ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    menuheight('igoods-rule');
");
?>