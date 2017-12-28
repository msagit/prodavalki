<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'TopUp';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-topup">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_clientform', [
        'model' => $model,
    ]) ?>

</div>
