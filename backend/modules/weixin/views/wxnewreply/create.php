<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wxnewreply */

$this->title = 'Create Wxnewreply';
$this->params['breadcrumbs'][] = ['label' => 'Wxnewreplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wxnewreply-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
