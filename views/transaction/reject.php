<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Reject Transaction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Reject';
?>
<div class="transaction-reject">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="transaction-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'admin_comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Reject', ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
