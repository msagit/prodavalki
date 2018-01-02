<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url; 
use app\models\Transaction; 

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = 'My Account';//$model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
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
        <?= Html::a('Return', ['transaction/return'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'acc_status',
            'balance',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataTrProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'created_at','format' =>['date', 'php:d.m.Y H:i:s']],
            //'account_id',
            'type',
            'purpose_type',
            'amount',
            'status',
            ['attribute' => 'updated_at','format' =>['date', 'php:d.m.Y H:i:s']],
            // 'last_updated',
            // 'created_time',
            // 'status_time',
            // 'linked_order_id',
            // 'linked_parcel_id',
            // 'comment',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}',
                'urlCreator' => function( $action, $model, $key, $index ){
                    if ($action == "view") {
                        return Url::to(['transaction/view', 'id' => $key]);
                    } elseif ($action == "delete"){
                        return Url::to(['transaction/cancel', 'id' => $key]);
                    }
                },
                'visibleButtons' => [
                  'delete' => function ($model, $key, $index) {
                             return $model->status === Transaction::STATUS_DRAFT && $model->purpose_type=== Transaction::PURPOSE_TYPE_TOPUP ? true : false;
                            }
                ],
            ],
        ],
            'rowOptions' => function ($model, $key, $index, $grid) {
              return ['style' => $model->purpose_type==Transaction::PURPOSE_TYPE_TOPUP?
                              ($model->status==Transaction::STATUS_REJECTED ? 
                                     'background-color:#fff0f0':
                                      ($model->status==Transaction::STATUS_APPROVED?
                                              'background-color:#f0fff0':
                                              ($model->status==Transaction::STATUS_CANCELED?'background-color:#f5f5f5':'background-color:#ffffff')
                                      )
                               ):
                               'background-color:#f0f0ff'];
            },

    ]); ?>
</div>
 </div>
