<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\DetailView;

class ClientInfo extends Widget
{
    public $account;

    public function init()
    {
        parent::init();
        //if (!isset($this->account)&&!Yii::$app->user->isGuest) {
        //   $account_id = Yii::$app->user->getIdentity()->getAccountId(); 
        //   $account=Account::findOne($account_id); 
        //}
    }

    public function run()
    {
        //return Html::encode($this->account);
        if (isset($this->account)&&!Yii::$app->user->isGuest) {
    echo  DetailView::widget([
        'model' => $this->account,
        'attributes' => [
            'id',
            [
		'label' => 'Username',
                'value' =>  $this->account->getClientname()
                 ,
            ],
            'acc_status',
            'balance',
            'invoiced',
        ],
    ]); 
    }
    }
}
?>