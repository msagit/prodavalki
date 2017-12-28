<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use app\widgets\ClientInfo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php if (isset($account)) { ?>
    <?= ClientInfo::widget(['account' => $account]) ?>
    <!--<?= DetailView::widget([
        'model' => $account,
        'attributes' => [
            'id',
            [
		'label' => 'Username',
                 //'value' =>date("d.m.Y H:i:s",$model->created_at)],
                //'attribute' => 'user_id',
                //'filter' => false,
                'value' =>  $account->getClientname()//Yii::t('User', 'Unknown user');
                 ,
            ],
            'acc_status',
            'balance',
        ],
    ]) ?> -->
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            'create_date',
            'item_url:url',
            'amount',
            // 'comment',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {orders} {parcels}',
                        'buttons' => [
                          'orders' => function ($url, $model, $key) {
                             //$url = Url::to(['transaction/appove', 'id' => $model->whatever_id]);
                             return Html::a(' <span class="glyphicon glyphicon-list"></span>', $url, ['title' => 'orders']);
                           },
                          'parcels' => function ($url, $model, $key) {
                             return Html::a(' <span class="glyphicon glyphicon-gift"></span>', $url, ['title' => 'parcels']);
                           },
                         ]
            ],

        ],
    ]); ?>
</div>
