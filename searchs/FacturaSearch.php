<?php
namespace app\searchs;

use app\models\Factura;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class FacturaSearch extends Factura
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista FACTURAS
     */
    public function rules()
    {
        return [
            [
                [
                    'Nnm_factura',
                    'cod_cliente',
                    'Nombre_empleado',
                    'Fecha_facturacion',
                    'cod_formapago'
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Factura::find();
        $query->leftJoin('cliente','Documento=cod_cliente');
        $query->leftJoin('forma_de_pago','id_formapago=cod_formapago');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize'=>20
            ],
            'sort' =>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        /*
         * Son los parámetros por el cual se puede realizar la búsqueda dentro del gridview
         */
        $query->andFilterWhere(['like', 'Nnm_factura', $this->Nnm_factura]);
        $query->andFilterWhere([
            'or',
            ['like', 'cliente.Nombres', $this->cod_cliente],
            ['like', 'cliente.Apellidos', $this->cod_cliente],
        ]);
        $query->andFilterWhere(['like', 'Nombre_empleado', $this->Nombre_empleado]);
        $query->andFilterWhere(['like', 'Fecha_facturacion', $this->Fecha_facturacion]);
        $query->andFilterWhere(['like', 'forma_de_pago.Descripcion_formapago', $this->cod_formapago]);

        return $dataProvider;
    }

}