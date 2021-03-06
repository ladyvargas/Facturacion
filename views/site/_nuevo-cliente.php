<?php

use app\models\Ciudad;
use app\models\TipoDocumento;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

/*
 * Este es el MODAL emergente que sirver para registrar los artículos al detalle de la factura
 * toma el modelo enviado desde la acción NUEVO CLIENTE y lo convierte en un formulario
 */
$form = ActiveForm::begin(['id'=>'registerform','options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model,'Documento');
echo $form->field($model, 'cod_tipo_documento')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todos los tipo de documentos disponibles
    'data' => ArrayHelper::map(TipoDocumento::getTipoDocumentos(), 'id_tipo_documento', 'Descripcion'),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo $form->field($model,'Nombres');
echo $form->field($model,'Apellidos');
echo $form->field($model,'Direccion');
echo $form->field($model, 'cod_ciudad')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todas las ciudades disponibles
    'data' => ArrayHelper::map(Ciudad::getCiudad(), 'Codigo_ciudad', 'Nombre_ciudad'),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo $form->field($model,'Telefono');
echo  Html::submitButton('Ingresar',['class'=>'btn btn-primary subm']);
ActiveForm::end();
?>

<script>
    $(function () {
        $('#registerform').submit(function (e) {
            $.ajax({
                url: 'nuevo-cliente',
                type: 'POST',
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data.code);
                    if (data.code === 1){
                        /*
                       Actualiza el gridview luego de registrar el nuevo cliente al sistema
                       */
                        $('#registerform').trigger('reset');
                        $(document).find('#modal').modal('hide');
                        $.pjax.reload({container: '#clientesGrid', timeout: false});
                    }
                },
            });
            e.preventDefault();
        });
    });
</script>