<?php

use app\models\Proveedor;
use app\models\TipoArticulo;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
/*
 * Este es el MODAL emergente que sirver para registrar los nuevos artículos al inventario
 * toma el modelo enviado desde la acción NUEVO ARTÍCULO y lo convierte en un formulario
 */
$form = ActiveForm::begin(['id'=>'registerform','options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model,'descripcion');
echo $form->field($model,'precio_venta');
echo $form->field($model,'precio_costo');
echo $form->field($model,'stock');
echo $form->field($model, 'cod_tipo_articulo')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todos los tipo de artículos disponibles
    'data' => ArrayHelper::map(TipoArticulo::getTipoArticulo(), 'id_tipoarticulo', 'descripcion_articulo'),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo $form->field($model, 'cod_proveedor')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todos los proveedores disponibles
    'data' => ArrayHelper::map(Proveedor::getProveedor(), 'No_documento', 'Nombre_comercial'),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo  Html::submitButton('Ingresar',['class'=>'btn btn-primary subm']);
ActiveForm::end();
?>

<script>
    $(function () {
        $('#registerform').submit(function (e) {
            $.ajax({
                url: 'nuevo-articulo',
                type: 'POST',
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data.code);
                    if (data.code === 1){
                        /*
                        Actualiza el gridview luego de registrar el nuevo artículo en el inventario
                        */
                        $('#registerform').trigger('reset');
                        $(document).find('#modal').modal('hide');
                        $.pjax.reload({container: '#articulosGrid', timeout: false});
                    }
                },
            });
            e.preventDefault();
        });
    });
</script>