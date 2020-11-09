<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/*
 * Este es el MODAL emergente que sirver para registrar los artículos al detalle de la factura
 * toma el modelo enviado desde la acción NUEVO CIUDAD y lo convierte en un formulario
 */
$form = ActiveForm::begin(['id'=>'registerform','options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model,'Nombre_ciudad');
echo  Html::submitButton('Ingresar',['class'=>'btn btn-primary subm']);
ActiveForm::end();
?>

<script>
    $(function () {
        $('#registerform').submit(function (e) {
            $.ajax({
                url: 'nuevo-ciudad',
                type: 'POST',
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data.code);
                    if (data.code === 1){
                        /*
                        Actualiza el gridview luego de registrar la nueva ciudad en el sistema
                        */
                        $('#registerform').trigger('reset');
                        $(document).find('#modal').modal('hide');
                        $.pjax.reload({container: '#ciudadGrid', timeout: false});
                    }
                },
            });
            e.preventDefault();
        });
    });
</script>