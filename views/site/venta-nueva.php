<?php

use app\models\Articulo;
use app\models\Cliente;
use app\models\FormaPago;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/*
 * Toma el modelo que envía la acción VENTA NUEVA y lo convierte en una
 * gridview SIN búsqueda
 */
?>

<div class="site-index">
    <h1>Nueva Venta</h1>
    <?php
    echo DetailView::widget([//detailview con el detalle de la factura en proceso
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
    <p>
        <?= HTML::button('Registrar Producto', ArrayHelper::merge(['value'=>Url::to(['nuevo','Factura'=>$_GET['factura']])], ['id'=>'modalButton', 'class'=>'btn btn-success'])); ?>
    </p>
    <?php
    /*
     * Este modal solo emergerá cuando se haga clic en el botón de arriba y se ejecute la acción NUEVO
     * para registrar un nuevo artículo en la factura en proceso
     */
    Modal::begin([
        'header' => '<h3>Productos</h3>',
        'id' => 'modal',
        'size'=>'modal-lg'
    ]);
    echo "<div class='clearfix' id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id'=>'detallesGrid']); ?>
    <?php
    $total = 0;
    foreach($dataProvider->models as $m){
        $total += $m->total;//Realiza la sumatoria del detalle de la factura (el SUBTOTAL)
    }
    ?>
    <?= GridView::widget([//gridview con el detalle de la factura en proceso
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'showFooter'=>TRUE,
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns'=>[
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'',
                'template' => '{eliminar}',
                'buttons' => [
                    'eliminar' => function ($url, $model) {//Este botón realiza la acción de quitar artículos del detalle de factura en proceso
                        return HTML::button('Quitar', ArrayHelper::merge(['value'=>$url], ['class'=>'btn btn-info _quitar','id'=>$model['cod_articulo'],'factura'=>$model['cod_factura']],['title' => Yii::t('app', 'Eliminar Producto')]));
                    }
                ],
            ],
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

    <?php $form = ActiveForm::begin(['id'=>'registerformX','options' => ['enctype' => 'multipart/form-data','method' => 'post'],'action' => ['site/venta-confirmada','factura'=>$_GET['factura']]]);
    echo $form->field($model,'IVA')->textInput(['readonly' => true, 'value' => $total*0.12]);//muestra el IVA de la factura
    echo $form->field($model, 'total_factura')->textInput(['readonly' => true, 'value' => $total*1.12]);//muestra el total de la factura
    if($total>0)
        echo  Html::submitButton('Confirmar Venta',['class'=>'btn btn-primary']);//Este botón solo se mostrará cuando existan artículos registrados en la factura en proceso
    ActiveForm::end();
    ?>
    <?php Pjax::end(); ?>
</div>
<?php
$urlQuitar=Yii::$app->getUrlManager()->createAbsoluteUrl('');
$script = <<< JS
$(document).ready(function() {
    $('body').on('click','._quitar', function(e){
        if (confirm('¿Desea QUITAR este producto?'))
            var val = $(this).val();
            $.ajax({
                url: '$urlQuitar'.concat(val),
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if (data.code === 1){
                        /*
                        Actualiza el gridview luego de quitar el artículo en el detalle de la factura en proceso
                        */
                        $.pjax.reload({container: '#detallesGrid', timeout: false});
                    }
                },
            });
        e.preventDefault();
    });
});
JS;
$this->registerJs($script);
?>
