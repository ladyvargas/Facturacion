<?php
namespace app\searchs;

use app\models\Ciudad;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CiudadSearch extends Ciudad
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista CIUDADES
     */
    public function rules()
    {
        return [
            [
                [
                    'Codigo_ciudad',
                    'Nombre_ciudad',
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Ciudad::find();

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
        $query->andFilterWhere(['like', 'Codigo_ciudad', $this->Codigo_ciudad]);
        $query->andFilterWhere(['like', 'Nombre_ciudad', $this->Nombre_ciudad]);

        return $dataProvider;
    }

}