<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/*
 * Toma el modelo que envía la acción ARTÍCULOS y lo convierte en una
 * gridview con búsqueda
 */
?>

<div class="site-index">
    <h1>Artículos</h1>
    <p>
        <?= HTML::button('Registrar Artículo', ArrayHelper::merge(['value'=>Url::to(['nuevo-articulo'])], ['id'=>'modalButton', 'class'=>'btn btn-success'])); ?>
    </p>
    <?php
    /*
     * Este modal solo emergerá cuando se haga clic en el botón de arriba y se ejecute la acción NUEVO ARTÍCULO
     */
    Modal::begin([
        'header' => '<h3>Nuevo Artículo</h3>',
        'id' => 'modal',
        'size'=>'modal-lg'
    ]);
    echo "<div class='clearfix' id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id'=>'articulosGrid']); ?>
    <?= GridView::widget([ //gridview con todos los artículos disponibles
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{pager}\n{items}\n{pager}",
            'options' => [
                'class' => 'table-responsive',
            ],
	    'columns' => [
		'id_articulo',
                'descripcion',
		[
		    'attribute' => 'precio_venta',
		    'value' => function ($data) {
			return '$ '.number_format($data['precio_venta'], 2, '.', '');
		    }
		],
                [
                    'attribute' => 'precio_costo',
                    'value' => function ($data) {
                        return '$ '.number_format($data['precio_costo'], 2, '.', '');
                    }
                ],
                'stock',
                'cod_tipo_articulo',
                'cod_proveedor',
                'fecha_ingreso'
	    ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
