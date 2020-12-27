<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * User model
 * @property string $Nnm_factura
 * @property string $cod_cliente
 * @property string $Nombre_empleado
 * @property string $Fecha_facturacion
 * @property int $cod_formapago
 * @property double $total_factura
 * @property double $IVA
 */

class Factura extends ActiveRecord
{

    public static function tableName()
    {
        return 'factura';
    }
    public function rules()
    {
        return [
            [
                [
                    'Nnm_factura', 'cod_cliente', 'Nombre_empleado', 'Fecha_facturacion', 'cod_formapago'
                ],
                'required'  //La regla REQUIRED obliga a llenar el formulario de INDEX (corresponde a la creación de una nueva factura)
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'Nnm_factura'=>'Factura',
            'cod_cliente'=>'Cliente',
            'Nombre_empleado'=>'Empleado',
            'Fecha_facturacion'=>'Fecha',
            'cod_formapago'=>'Forma de pago',
            'total_factura'=>'Total',
            'IVA'=>'IVA'
        ];
    }
    public static function findById($id)//Busca una factura en específico a traves de su ID
    {
        return self::find()->where(['Nnm_factura' => $id])->one();
    }
    public static function getNuevaFactura()//Busca la última factura ingresada para continuar con la venta y agregar su respectivo DETALLE FACTURA
    {
        return self::find()->select('Nnm_factura, length(Nnm_factura) AS length_num_fact')->orderBy(['length_num_fact' => SORT_DESC, 'Nnm_factura' => SORT_DESC])->one();
    }
}
