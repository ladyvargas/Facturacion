<?php

use app\models\Cliente;
use app\models\FormaPago;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/*
 * Toma el modelo que envía la acción FACTURAS y lo convierte en una
 * gridview con búsqueda
 */
?>

<div class="site-index">
    <h1>Facturas</h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([//gridview con todos las facturas emitidas
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}\n{items}\n{pager}",
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns'=>[
            'Nnm_factura',
            [
                'attribute'=>'cod_cliente',
                'value' => function ($data) {//Muestra el nombre del cliente que registró la factura
                    $cliente = Cliente::findById($data->cod_cliente);
                    if(!isset($cliente->Apellidos))
                        $nama=null;
                    else
                        $nama = $cliente->Apellidos.' '.$cliente->Nombres;
                    return $nama;
                },
            ],
            'Nombre_empleado',
            'Fecha_facturacion',
            [
                'attribute'=>'cod_formapago',
                'value' => function ($data) {//Muestra el nombre del tipo de pago que registró la factura
                    $forma = FormaPago::findById($data->cod_formapago);
                    if(!isset($forma->Descripcion_formapago))
                        $nama=null;
                    else
                        $nama = $forma->Descripcion_formapago;
                    return $nama;
                },
            ],
            'total_factura',
            'IVA',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'',
                'template' => '{ver}{imprimir}',
                'contentOptions' => ['style' => 'width:150px; white-space:nowrap;'],
                'buttons' => [ //Se crea un botón con la acción VER para visualizar los detalles de una factura emitida
                    'ver' => function ($url, $model) {
                        return HTML::a('Ver', ['site/ver','factura'=>$model->Nnm_factura],['class'=>'btn btn-primary']);
                    },
                    'imprimir' => function ($url, $model) {
                        return HTML::a('Imprimir', ['site/imprimir','factura'=>$model->Nnm_factura],['target' => '_blank' ,'data-pjax'=>"0",'class'=>'btn btn-success']);
                    }
                ],
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>