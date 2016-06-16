<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model supplier\models\Person */

$this->title = '客户详情';
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'sex',
                        'age',
                        'profession',
                        'created_at',
                        'updated_at',
                        'integral',
                    ],
                    'template' => '<tr><th width="150px;">{label}</th><td>{value}</td></tr>',
                ]) ?>
            </div>
        </div>
    </div>
</div>
