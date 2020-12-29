<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/*
 * Toma el modelo que envía la acción USIARIOS y lo convierte en una
 * gridview con búsqueda
 */
?>

<div class="site-index">
    <h1>Usuarios</h1>
    <p>
        <?= HTML::button('Registrar Usuario', ArrayHelper::merge(['value' => Url::to(['nuevo-usuario'])], ['id' => 'modalButton', 'class' => 'btn btn-success'])); ?>
    </p>
    <?php
    /*
     * Este modal solo emergerá cuando se haga clic en el botón de arriba y se ejecute la acción NUEVO ARTÍCULO
     */
    Modal::begin([
        'header' => '<h3>Nuevo Usuario</h3>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div class='clearfix' id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id' => 'usuariosGrid']); ?>
    <?= GridView::widget([ //gridview con todos los artículos disponibles
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}\n{items}\n{pager}",
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns' => [
            'username',
            [
                'attribute' => 'active',
                'value' => function ($data) {
                    return $data['active'] == 1 ? 'activo' : 'inactivo';
                }
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
