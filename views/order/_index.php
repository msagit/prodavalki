<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Orders</h1>
<ul>
<?php foreach ($orders as $order): ?>
    <li>
<ul>
    <li><label>ID</label>: <?= Html::encode($model->id) ?></li>
    <li><label>URL</label>: <?= Html::encode($model->item_url) ?></li>
    <li><label>Amount</label>: <?= Html::encode($model->amount) ?></li>
    <li><label>Comment</label>: <?= Html::encode($model->comment) ?></li>
</ul>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>