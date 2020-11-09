<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property string $No_documento
 * @property int $cod_tipo_documento
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Nombre_comercial
 * @property int $direccion
 * @property int $cod_ciudad
 * @property string $Telefono
 */

class Proveedor extends ActiveRecord
{

    public static function tableName()
    {
        return 'proveedor';
    }
    public function rules()
    {
        return [
            [
                [
                    'No_documento',
                    'cod_tipo_documento',
                    'Nombre',
                    'Apellido',
                    'direccion',
                    'Nombre_comercial',
                    'cod_ciudad',
                    'Telefono'
                ],
                'required' //La regla REQUIRED obliga a llenar el formulario de NUEVO PROVEEDOR
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'No_documento'=>'Documento',
            'cod_tipo_documento'=>'Tipo de Documento',
            'Nombre',
            'Apellido',
            'direccion'=>'Dirección',
            'Nombre_comercial'=>'Razón Social',
            'cod_ciudad'=>'Ciudad',
            'Telefono'=>'Teléfono'
        ];
    }
    public static function findById($id)//Busca un proveedor en específico a traves de su ID
    {
        return self::find()->where(['No_documento' => $id])->one();
    }
    public static function getProveedor()//Busca todos los proveedores disponibles
    {
        return self::find()->all();
    }
}