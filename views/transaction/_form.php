<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_id')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'debit' => 'Debit', 'credit' => 'Credit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'purpose_type')->dropDownList([ 'topup' => 'Topup', 'order' => 'Order', 'delivery' => 'Delivery', 'parcel' => 'Parcel', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'draft' => 'Draft', 'approved' => 'Approved', 'rejected' => 'Rejected', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'last_updated')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status_time')->textInput() ?>

    <?= $form->field($model, 'linked_order_id')->textInput() ?>

    <?= $form->field($model, 'linked_parcel_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
