<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wxlinkreply */

$this->title = 'Create Wxlinkreply';
$this->params['breadcrumbs'][] = ['label' => 'Wxlinkreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wxlinkreply-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
