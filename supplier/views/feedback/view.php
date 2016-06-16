<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model supplier\models\Feedback */

$this->title = '留言';
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div class="col-sm-offset-1" style="font-size: 1.5rem;">
                    <?= $model->content ?>
                </div>
            </div>
        </div>
    </div>
</div>
