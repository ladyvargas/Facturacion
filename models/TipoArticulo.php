<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property int $id_tipoarticulo
 * @property string $descripcion_articulo
 */

class TipoArticulo extends ActiveRecord
{

    public static function tableName()
    {
        return 'tipo_articulo';
    }
    public function rules()
    {
        return [
            [
                [
                    'descripcion_articulo',
                ],
                'required'//La regla REQUIRED obliga a llenar el formulario de NUEVO TIPO ARTÍCULO
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'descripcion_articulo'=>'Descripción Tipo de Artículo',
        ];
    }
    public static function findById($id)//Busca un tipo de artículo en específico a traves de su ID
    {
        return self::find()->where(['id_tipoarticulo' => $id])->one();
    }
    public static function getTipoArticulo()//Busca todos los tipo de artículos disponibles
    {
        return self::find()->all();
    }
}