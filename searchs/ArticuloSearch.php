<?php
namespace app\searchs;

use app\models\Articulo;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticuloSearch extends Articulo
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista ARTÍCULOS
     */
    public function rules()
    {
        return [
            [
                [
                    'id_articulo',
                    'descripcion',
                    'precio_venta',
                    'precio_costo',
                    'stock',
                    'cod_tipo_articulo',
                    'cod_proveedor',
                    'fecha_ingreso'
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Articulo::find()->orderBy(['id_articulo'=>SORT_DESC]);

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
        $query->andFilterWhere(['like', 'id_articulo', $this->id_articulo]);
        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);
        $query->andFilterWhere(['like', 'precio_venta', $this->precio_venta]);
        $query->andFilterWhere(['like', 'precio_costo', $this->precio_costo]);
        $query->andFilterWhere(['like', 'stock', $this->stock]);
        $query->andFilterWhere(['like', 'cod_tipo_articulo', $this->cod_tipo_articulo]);
        $query->andFilterWhere(['like', 'cod_proveedor', $this->cod_proveedor]);
        $query->andFilterWhere(['like', 'fecha_ingreso', $this->fecha_ingreso]);

        return $dataProvider;
    }

}
