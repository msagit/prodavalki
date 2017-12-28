<?php
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <li><label>URL</label>: <?= Html::encode($model->url) ?></li>
    <li><label>Amount</label>: <?= Html::encode($model->amount) ?></li>
    <li><label>Comment</label>: <?= Html::encode($model->comment) ?></li>
</ul>