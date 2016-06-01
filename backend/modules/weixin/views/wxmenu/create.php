<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wxmenu */

$this->title = 'Create Wxmenu';
$this->params['breadcrumbs'][] = ['label' => 'Wxmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wxmenu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
