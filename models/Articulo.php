<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property int $id_articulo
 * @property string $descripcion
 * @property int $precio_venta
 * @property int $precio_costo
 * @property int $stock
 * @property int $cod_tipo_articulo
 * @property string $cod_proveedor
 * @property string $fecha_ingreso
 */

class Articulo extends ActiveRecord
{
    /*
     * Esta es una clase que utiliza el modelo de la tabla mensionada,
     * con sus respectivos atributos como propiedades de este modelo
     */
    public static function tableName()
    {
        return 'articulo';
    }
    public function rules()
    {
        return [
            [
                [
                    'descripcion',
                    'precio_venta',
                    'precio_costo',
                    'stock',
                    'cod_tipo_articulo',
                    'cod_proveedor',
                    'fecha_ingreso'
                ], 'required'], //La regla REQUIRED obliga a llenar el formulario de NUEVO ARTÍCULO
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_articulo'=>'Id',
            'descripcion'=>'Descripción',
            'precio_venta'=>'Precio Venta',
            'precio_costo'=>'Precio Costo',
            'stock'=>'Stock',
            'cod_tipo_articulo'=>'Código Tipo Producto',
            'cod_proveedor'=>'Código Proveedor',
            'fecha_ingreso'=>'Ingreso'
        ];
    }
    public static function findById($id) //Busca un artículo en específico a traves de su ID
    {
        return self::find()->where(['id_articulo' => $id])->one();
    }
    public static function getArticulosDisponibles()//Busca todos los artículos disponibles con un STOCK mayor a 0
    {
        return self::find()->where(['>','stock','0'])->orderBy(['descripcion' => SORT_ASC])->all();
    }
}