<?php
namespace app\searchs;

use app\models\TipoArticulo;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TipoArticuloSearch extends TipoArticulo
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista TIPO ARTÍCULOS
     */
    public function rules()
    {
        return [
            [
                [
                    'id_tipoarticulo',
                    'descripcion_articulo',
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TipoArticulo::find();

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
        $query->andFilterWhere(['like', 'id_tipoarticulo', $this->id_tipoarticulo]);
        $query->andFilterWhere(['like', 'descripcion_articulo', $this->descripcion_articulo]);

        return $dataProvider;
    }

}