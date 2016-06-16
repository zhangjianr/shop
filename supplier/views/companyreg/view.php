<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model supplier\models\CompanyReg */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-reg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_name',
            'company_tel',
            'company_address',
            'contact_name',
            'phone',
            'industry',
            'introduct:ntext',
            'username',
            'auth_key',
            'password_hash',
            'created_at',
            'updated_at',
            'status',
            'credit',
            'organization',
            'tax',
            'license',
        ],
    ]) ?>

</div>
