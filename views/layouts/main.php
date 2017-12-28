<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        //'options' => ['class' =>'nav-pills'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            !Yii::$app->user->isGuest?(//&&Yii::$app->user->getIdentity()->isAdmin() ?  (
            [
            'label' => 'Admin',
            'items' => [
                 //['label' => 'Manage transactions', 'url' => ['transaction/manage']],
                 //['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                 //'<li class="divider"></li>',
                 '<li class="dropdown-header">Accounts</li>',
                 ['label' => 'Manage', 'url' => ['account/manage']],
                 ['label' => 'Index', 'url' => ['account/index']],
                 '<li class="dropdown-header">Transactions</li>',
                 ['label' => 'Index', 'url' => ['transaction/index']],
                 ['label' => 'Manage topups', 'url' => ['transaction/manage']],
                 '<li class="dropdown-header">Orders</li>',
                 ['label' => 'Manage', 'url' => ['order/manage']],
                 ['label' => 'Report', 'url' => ['order/repot']],
            ]
            ]
            ):(' '),
            !Yii::$app->user->isGuest&&Yii::$app->user->getIdentity()->isClient() ? (
               //['label' => 'My Orders', 'url' => ['order/index']]
            [
             'label' => 'My cabinet',
               'items' => [
                ['label' => 'My Orders', 'url' => ['order/index']],
                ['label' => 'My Account', 'url' => ['account/viewmy']],
                ['label' => 'My Parcels', 'url' => ['parcel/index']]
               ]
            ]
            ):(' '),
            //Yii::$app->user->isGuest ? (' '
            //) : (
            //   ['label' => 'My Account', 'url' => ['account/viewmy']]
            //),
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Poland2UA <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
