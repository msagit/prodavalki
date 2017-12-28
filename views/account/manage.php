<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
		'label' => 'Username',
                'attribute' => 'user_id',
                'filter' => false,
                'content' => function($model) {
                        return $model->getClientname();//Yii::t('User', 'Unknown user');
                } ,
            ],
            'acc_status',
            'balance',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {orders} {parcels}',
                        'buttons' => [
                          'orders' => function ($url, $model, $key) {
                             $url = Url::to(['order/manage', 'account_id' => $model->id]);
                             return Html::a(' <span class="glyphicon glyphicon-list"></span>', $url, ['title' => 'orders']);
                           },
                          'parcels' => function ($url, $model, $key) {
                             $url = Url::to(['parcel/manage', 'account_id' => $model->id]);
                             return Html::a(' <span class="glyphicon glyphicon-gift"></span>', $url, ['title' => 'parcels']);
                           },
                         ]
            ],

        ],
    ]); ?>
</div>
