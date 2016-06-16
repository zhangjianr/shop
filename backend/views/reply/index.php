<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\ReplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'sid',
                        'did',
                        'order_id',
                        'content:ntext',
                        // 'type',
                        // 'created_at',
                        // 'start',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("

    menuheight('reply-index');
");
?>