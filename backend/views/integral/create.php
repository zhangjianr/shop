<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Integral */

$this->title = 'Create Integral';
$this->params['breadcrumbs'][] = ['label' => 'Integrals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integral-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
