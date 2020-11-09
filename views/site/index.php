<?php

use app\models\Cliente;
use app\models\FormaPago;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/*
 * Toma el modelo que envía la acción INDEX y lo convierte en un
 * formulario para crear una NUEVA FACTURA
 */
$form = ActiveForm::begin(['id'=>'registerform','options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model, 'cod_cliente')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todos los clientes disponibles
    'data' => ArrayHelper::map(Cliente::getClientes(), 'Documento', function($model) {return $model['Documento'].' '.$model['Apellidos'].' '.$model['Nombres'];}),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo $form->field($model,'Nombre_empleado');
echo $form->field($model, 'cod_formapago')->widget(Select2::classname(), [//Este widget muestra en forma de DROPDOWN MENU todos las formas de pago disponibles
    'data' => ArrayHelper::map(FormaPago::getFormas(), 'id_formapago', 'Descripcion_formapago'),
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => false,
        'placeholder' => '',
    ],
]);
echo  Html::submitButton('Crear Factura',['class'=>'btn btn-primary']);
ActiveForm::end();