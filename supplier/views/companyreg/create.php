<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model supplier\models\CompanyReg */

$this->title = 'Create Company Reg';
$this->params['breadcrumbs'][] = ['label' => 'Company Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-reg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
