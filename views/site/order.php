<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<p>Make your order:</p>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>