<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/*
 * Toma el modelo que envía la acción TIPO ARTÍCULOS y lo convierte en una
 * gridview con búsqueda
 */
?>

<div class="site-index">
    <h1>Tipo de Artículos</h1>
    <p>
        <?= HTML::button('Registrar Cliente', ArrayHelper::merge(['value'=>Url::to(['nuevo-tipo-articulo'])], ['id'=>'modalButton', 'class'=>'btn btn-success'])); ?>
    </p>
    <?php
    /*
     * Este modal solo emergerá cuando se haga clic en el botón de arriba y se ejecute la acción NUEVO TIPO ARTICULO
     */
    Modal::begin([
        'header' => '<h3>Nuevo Tipo de Artículo</h3>',
        'id' => 'modal',
        'size'=>'modal-lg'
    ]);
    echo "<div class='clearfix' id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id'=>'tipoArticuloGrid']); ?>
    <?= GridView::widget([//gridview con todos los tipo de artículos disponibles
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}\n{items}\n{pager}",
        'options' => [
            'class' => 'table-responsive',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>