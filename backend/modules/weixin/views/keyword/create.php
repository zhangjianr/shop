<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Keyword */

$this->params['breadcrumbs'][] = ['label' => 'Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyword-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
