<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property int $id_formapago
 * @property string $Descripcion_formapago
 */

class FormaPago extends ActiveRecord
{

    public static function tableName()
    {
        return 'forma_de_pago';
    }
    public function rules()
    {
        return [
            [
                [
                    'id_formapago', 'Descripcion_formapago',
                ],
                'required'
            ],
        ];
    }
    public static function findById($id) //Busca una forma de pago en específico a traves de su ID
    {
        return self::find()->where(['id_formapago' => $id])->one();
    }
    public static function getFormas()//Busca todos las formas de pago disponibles
    {
        return self::find()->orderBy(['Descripcion_formapago' => SORT_ASC])->all();
    }
}