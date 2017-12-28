<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'create_date',
            'item_url:url',
            'amount',
            // 'comment',

            ['class' => 'yii\grid\ActionColumn'],
            /*['class' => 'yii\grid\ActionColumn', 'template' => '{view} | {orders} | {parcels}',
                        'buttons' => [
                          'approve' => function ($url, $model, $key) {
                             //$url = Url::to(['transaction/appove', 'id' => $model->whatever_id]);
                             return Html::a(' <span class="glyphicon glyphicon-film"></span>', $url, ['title' => 'orders']);
                           },
                          'reject' => function ($url, $model, $key) {
                             return Html::a(' <span class="glyphicon glyphicon-th-large"></span>', $url, ['title' => 'parcels']);
                           },
                         ]
            ],*/

        ],
    ]); ?>
</div>
