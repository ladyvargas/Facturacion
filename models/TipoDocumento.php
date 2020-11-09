<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property int $id_tipo_documento
 * @property string $Descripcion
 */

class TipoDocumento extends ActiveRecord
{

    public static function tableName()
    {
        return 'tipo_de_documento';
    }
    public function rules()
    {
        return [
            [
                [
                    'id_tipo_documento', 'Descripcion',
                ],
                'required'
            ],
        ];
    }
    public static function findById($id)//Busca un tipo de documento en específico a traves de su ID
    {
        return self::find()->where(['id_tipo_documento' => $id])->one();
    }
    public static function getTipoDocumentos()//Busca todos los tipo de documentos disponibles
    {
        return self::find()->all();
    }
}