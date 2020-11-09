<?php

use app\models\Articulo;
use app\models\Cliente;
use app\models\FormaPago;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

if(!isset($dataProvider))
    $dataProvider=null;
if(!isset($searchModel))
    $searchModel=null;
/*
 * Toma el modelo que envía la acción VER y lo convierte en una
 * gridview con búsqueda
 */
?>

    <div class="site-index">
        <h1>Detalle</h1>
        <?php
        echo DetailView::widget([//detailview con el detalle de la factura emitida
            'model' => $model,
            'attributes' => [
                'Nnm_factura',
                [
                    'attribute' => 'cod_formapago',
                    'value' => function ($data) {//Muestra el nombre del tipo de pago que registró la factura
                        $forma = FormaPago::findById($data->cod_formapago);
                        if(!isset($forma->Descripcion_formapago))
                            $nama=null;
                        else
                            $nama = $forma->Descripcion_formapago;
                        return $nama;
                    },
                ],
                [
                    'attribute' => 'cod_cliente',
                    'value' => function ($data) {//Muestra el nombre del cliente que registró la factura
                        $cliente = Cliente::findById($data->cod_cliente);
                        if(!isset($cliente->Apellidos))
                            $nama=null;
                        else
                            $nama = $cliente->Apellidos.' '.$cliente->Nombres;
                        return $nama;
                    },
                ],
                'Fecha_facturacion',
            ],
        ]);
        ?>
        <?php
        $total = 0;
        foreach($dataProvider->models as $m){
            $total += $m->total; //Realiza la sumatoria del detalle de la factura (el SUBTOTAL)
        }
        ?>
        <?= GridView::widget([//gridview con el detalle de la factura emitida
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'showFooter'=>TRUE,
            'options' => [
                'class' => 'table-responsive',
            ],
            'columns'=>[
                [
                    'attribute'=>'cantidad',
                ],
                [
                    'attribute'=>'cod_articulo',
                    'value'=>function ($data) {//Muestra el nombre del articulo registrado en la factura
                        $articulo = Articulo::findById($data->cod_articulo);
                        $nama = $articulo->descripcion;
                        return $nama;
                    },
                ],
                [
                    'label'=>'Precio Unitario',
                    'attribute'=>'cod_articulo',
                    'value'=>function ($data) {//Muestra el precio de venta del articulo registrado en la factura
                        $articulo = Articulo::findById($data->cod_articulo);
                        $nama = $articulo->precio_venta;
                        return $nama;
                    },
                    'footer' => '<strong>SUB TOTAL</strong>'
                ],
                [
                    'attribute'=>'total',
                    'footer' => '<strong>'.$total.'</strong>'
                ],
            ]
        ]); ?>

        <?php $form = ActiveForm::begin(['id'=>'registerformX','action' => null]);
        echo $form->field($model,'IVA')->textInput(['readonly' => true, 'value' => $total*0.12]);//muestra el IVA de la factura
        echo $form->field($model, 'total_factura')->textInput(['readonly' => true, 'value' => $total*1.12]);//muestra el total de la factura
        ActiveForm::end();
        ?>
    </div>