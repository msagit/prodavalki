<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Topup Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php //if(Yii::$app->session->hasFlash('transactionError')) { ?>
    <?php
    //$errors = Yii::$app->session->getFlash('transactionError');
    //$model->addErrors(unserialize($errors));
    //echo $errors;
	
    ?>
<?php //} ?>
<?php //Alert::widget(); ?>
<div class="transaction-manage">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'created_at','format' =>['date', 'php:d.m.Y H:i:s']],
            'account_id',
            [
		'label' => 'Username',
                'attribute' => 'account_id',
                'filter' => false,
                'content' => function($model) {
                    //if($productModel = $model->product) {
                    //    return $productModel->getCartId().'. '.$productModel->getCartName();
                    //} else {
                        return $model->getClientName();//Yii::t('User', 'Unknown user');
                    //}
                } ,
                //'options' => [ 'style' => $model->status=='draft' ? 'background-color:#FF0000':'background-color:#0000FF'],
            ],

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
            ['attribute' => 'updated_at','format' =>['date', 'php:d.m.Y H:i:s']],

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{approve} | {reject}',
                        'buttons' => [
                          'approve' => function ($url, $model, $key) {
                             //$url = Url::to(['transaction/appove', 'id' => $model->whatever_id]);
                             return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, ['title' => 'approve']);
                           },
                          'reject' => function ($url, $model, $key) {
                             return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, ['title' => 'reject']);
                           },
                         ]
            ],

        ],
    ]); ?>
</div>
