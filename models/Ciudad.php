<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property int $Codigo_ciudad
 * @property string $Nombre_ciudad
 */

class Ciudad extends ActiveRecord
{

    public static function tableName()
    {
        return 'ciudad';
    }
    public function rules()
    {
        return [
            [
                [
                    'Nombre_ciudad',
                ],
                'required'//La regla REQUIRED obliga a llenar el formulario de NUEVO CIUDAD
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'Nombre_ciudad'=>'Nombre de la Ciudad',
        ];
    }
    public static function findById($id)//Busca una ciudad en específico a traves de su ID
    {
        return self::find()->where(['Codigo_ciudad' => $id])->one();
    }
    public static function getCiudad()//Busca todos las CIUDADES disponibles
    {
        return self::find()->all();
    }
}