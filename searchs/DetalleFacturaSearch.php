<?php
namespace app\searchs;

use app\models\DetalleFactura;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DetalleFacturaSearch extends DetalleFactura
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista VENTA NUEVA
     */
    public function rules()
    {
        return [
            [
                [
                    'cod_factura', 'cod_articulo', 'cantidad', 'total'
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params,$factura)
    {
        $query = DetalleFactura::find();

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

        $query->andFilterWhere(['=', 'cod_factura', $factura]);

        return $dataProvider;
    }

}