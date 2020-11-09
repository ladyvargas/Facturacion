<?php

use app\models\Ciudad;
use app\models\TipoDocumento;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/*
 * Toma el modelo que envía la acción CLIENTES y lo convierte en una
 * gridview con búsqueda
 */
?>

<div class="site-index">
    <h1>Clientes</h1>
    <p>
        <?= HTML::button('Registrar Cliente', ArrayHelper::merge(['value'=>Url::to(['nuevo-cliente'])], ['id'=>'modalButton', 'class'=>'btn btn-success'])); ?>
    </p>
    <?php
    /*
     * Este modal solo emergerá cuando se haga clic en el botón de arriba y se ejecute la acción NUEVO CLIENTE
     */
    Modal::begin([
        'header' => '<h3>Nuevo Cliente</h3>',
        'id' => 'modal',
        'size'=>'modal-lg'
    ]);
    echo "<div class='clearfix' id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id'=>'clientesGrid']); ?>
    <?= GridView::widget([//gridview con todos los clientes disponibles
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}\n{items}\n{pager}",
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns'=>[
            'Documento',
            [
                'attribute'=>'cod_tipo_documento',
                'value' => function ($data) {//Muestra el nombre del tipo de documento que registró el cliente
                    $documento = TipoDocumento::findById($data->cod_tipo_documento);
                    if(!isset($documento->Descripcion))
                        $nama=null;
                    else
                        $nama = $documento->Descripcion;
                    return $nama;
                },
            ],
            'Nombres',
            'Apellidos',
            [
                'attribute'=>'cod_ciudad',
                'value' => function ($data) {//Muestra el nombre de la ciudad que registró el cliente
                    $ciudad = Ciudad::findById($data->cod_ciudad);
                    if(!isset($ciudad->Nombre_ciudad))
                        $nama=null;
                    else
                        $nama = $ciudad->Nombre_ciudad;
                    return $nama;
                },
            ],
            'Direccion',
            'Telefono'
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>