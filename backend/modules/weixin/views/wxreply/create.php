<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wxreply */

$this->title = 'Create Wxreply';
$this->params['breadcrumbs'][] = ['label' => 'Wxreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wxreply-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
