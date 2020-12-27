<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\Rol;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src=' . Yii::$app->getUrlManager()->createAbsoluteUrl('img/farmacia.jpeg') . ' style="display:inline; vertical-align: top; height:46px;"> ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' =>
            Yii::$app->user->isGuest ? (
            [
                ['label' => 'Ingresar', 'url' => ['/site/login']]]
            ) : (
            [['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Facturas', 'url' => ['/site/facturas']],
                Rol::getAdmin()?['label' => 'Clientes', 'url' => ['/site/clientes']]:'',
                Rol::getAdmin()?['label' => 'Ciudades', 'url' => ['/site/ciudad']]:'',
                Rol::getAdmin()?['label' => 'Proveedores', 'url' => ['/site/proveedor']]:'',
                Rol::getAdmin()?['label' => 'Productos', 'url' => ['/site/articulos']]:'',
                Rol::getAdmin()?['label' => 'Tipo de Artículos', 'url' => ['/site/tipo-articulos']]:'',
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Cerrar Sesión',
                    [
                        'class' => 'btn btn-link logout',
                        'title' => Yii::t('app', 'Cerrar Sesión')
                    ]
                )
                . Html::endForm()
                . '</li>']
            ),
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
