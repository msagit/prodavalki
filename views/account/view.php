<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <!--
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])?>-->
        <?= Html::a('Topup', ['transaction/topup'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'acc_status',
            'balance',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataTrProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'account_id',
            'type',
            'purpose_type',
            'amount',
            'status',
            // 'last_updated',
            // 'created_time',
            // 'status_time',
            // 'linked_order_id',
            // 'linked_parcel_id',
            // 'comment',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 </div>
