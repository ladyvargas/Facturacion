<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property string $Documento
 * @property int $cod_tipo_documento
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $Direccion
 * @property int $cod_ciudad
 * @property string $Telefono
 */

class Cliente extends ActiveRecord
{

    public static function tableName()
    {
        return 'cliente';
    }
    public function rules()
    {
        return [
            [
                [
                    'Documento',
                    'cod_tipo_documento',
                    'Nombres',
                    'Apellidos',
                    'Direccion',
                    'cod_ciudad',
                    'Telefono'
                ], 'required'],//La regla REQUIRED obliga a llenar el formulario de NUEVO CLIENTE
        ];
    }
    public function attributeLabels()
    {
        return [
            'Documento',
            'cod_tipo_documento'=>'Tipo de Documento',
            'Nombres',
            'Apellidos',
            'Direccion'=>'Dirección',
            'cod_ciudad'=>'Ciudad',
            'Telefono'=>'Teléfono'
        ];
    }
    public static function findById($id)//Busca un artículo en específico a traves de su ID
    {
        return self::find()->where(['Documento' => $id])->one();
    }
    public static function getClientes()//Busca todos los clientes disponibles y los ordena por apellidos
    {
        return self::find()->orderBy(['Apellidos' => SORT_ASC])->all();
    }
}