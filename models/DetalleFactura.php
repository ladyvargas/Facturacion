<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property string $cod_factura
 * @property int $cod_articulo
 * @property int $cantidad
 * @property double $total
 */

class DetalleFactura extends ActiveRecord
{
    public static function tableName()
    {
        return 'detalle_factura';
    }
    public function rules()
    {
        return [
            [
                [
                    'cod_factura', 'cod_articulo', 'cantidad','total'
                ],
                'required' //La regla REQUIRED obliga a llenar el formulario de NUEVO
            ],
            ['cantidad', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
        ];
    }
    public function attributeLabels()
    {
        return [

            'cod_factura'=>'Factura',
            'cod_articulo'=>'Artículo',
            'cantidad'=>'Cantidad',
            'total'=>'Sub Total'
        ];
    }
    public static function findById($id)//Busca un detalle de factura en específico, por código factura
    {
        return self::find()->where(['cod_factura' => $id])->all();
    }
    public static function findSumById($id) //La regla REQUIRED obliga a llenar el formulario de NUEVO ARTÍCULO
    {
        return self::find()->where(['cod_factura' => $id])->sum('total');
    }
    public static function findByIdCod($id,$cod)//Busca un detalle de factura en específico, por código factura y código de artículo
    {
        return self::find()->where(['cod_factura' => $id,'cod_articulo'=>$cod])->one();
    }
}