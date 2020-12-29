<?php

use app\models\Articulo;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

/*
 * Este es el MODAL emergente que sirver para registrar los artículos al detalle de la factura
 * toma el modelo enviado desde la acción NUEVO y lo convierte en un formulario
 */
$form = ActiveForm::begin(['id' => 'registerform', 'options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model, 'cod_articulo')->widget(Select2::classname(), [ //Este widget muestra en forma de DROPDOWN MENU todos los artículos disponibles
    'data' => ArrayHelper::map(Articulo::getArticulosDisponibles(), 'id_articulo', function ($data) {
        return $data['descripcion'] . ' (' . $data['stock'] . ') - $ ' . number_format($data['precio_venta'], 2, '.', '');
    }),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo $form->field($model, 'cod_factura')->hiddenInput(['value' => $factura])->label(false);
echo $form->field($model, 'cantidad')->textInput(['type' => 'number']);
echo Html::submitButton('Ingresar', ['class' => 'btn btn-primary subm']);
ActiveForm::end();
?>

<script>
    $(function () {
        $('#registerform').submit(function (e) {
            $.ajax({
                url: 'nuevo',
                type: 'POST',
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data.code);
                    if (data.code === 1) {
                        /*
                        Actualiza el gridview luego de registrar el nuevo artículo en el detalle de la factura
                        */
                        $('#registerform').trigger('reset');
                        $(document).find('#modal').modal('hide');
                        $.pjax.reload({container: '#detallesGrid', timeout: false});
                    }
                    if (data.code === 2) {
                        /*
                        Sirve para validar que no se ingrese una cantidad mayor al stock del artículo
                         */
                        alert('Cantidad no puede ser mayor al stock');
                    }
                },
            });
            e.preventDefault();
        });
    });
</script>