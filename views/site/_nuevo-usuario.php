<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/*
 * Este es el MODAL emergente que sirver para registrar los nuevos usurios al inventario
 * toma el modelo enviado desde la acción NUEVO USUARIO y lo convierte en un formulario
 */
$form = ActiveForm::begin(['id'=>'registerform','options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model,'username');
echo $form->field($model,'password');
echo  Html::submitButton('Ingresar',['class'=>'btn btn-primary subm']);
ActiveForm::end();
?>

<script>
    $(function () {
        $('#registerform').submit(function (e) {
            $.ajax({
                url: 'nuevo-usuario',
                type: 'POST',
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data);
                    if (data.code === 1){
                        /*
                        Actualiza el gridview luego de registrar el nuevo usuario en el inventario
                        */
                        $('#registerform').trigger('reset');
                        $(document).find('#modal').modal('hide');
                        $.pjax.reload({container: '#usuariosGrid', timeout: false});
                    }
                },
            });
            e.preventDefault();
        });
    });
</script>