<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel supplier\models\searchs\CompanyRegSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Regs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-reg-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company Reg', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_name',
            'company_tel',
            'company_address',
            'contact_name',
            // 'phone',
            // 'industry',
            // 'introduct:ntext',
            // 'username',
            // 'auth_key',
            // 'password_hash',
            // 'created_at',
            // 'updated_at',
            // 'status',
            // 'credit',
            // 'organization',
            // 'tax',
            // 'license',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
