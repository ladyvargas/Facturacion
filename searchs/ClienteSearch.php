<?php
namespace app\searchs;

use app\models\Cliente;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ClienteSearch extends Cliente
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista CLIENTES
     */
    public function rules()
    {
        return [
            [
                [
                    'Documento',
                    'cod_tipo_documento',
                    'Nombres',
                    'Apellidos',
                    'Direccion',
                    'cod_ciudad',
                    'Telefono'
                ], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Cliente::find();
        $query->leftJoin('tipo_de_documento','id_tipo_documento=cod_tipo_documento');
        $query->leftJoin('ciudad','Codigo_ciudad=cod_ciudad');

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
        $query->andFilterWhere(['like', 'Documento', $this->Documento]);
        $query->andFilterWhere(['like', 'tipo_de_documento.Descripcion', $this->cod_tipo_documento]);
        $query->andFilterWhere(['like', 'Nombres', $this->Nombres]);
        $query->andFilterWhere(['like', 'Apellidos', $this->Apellidos]);
        $query->andFilterWhere(['like', 'Direccion', $this->Direccion]);
        $query->andFilterWhere(['like', 'ciudad.Nombre_ciudad', $this->cod_ciudad]);
        $query->andFilterWhere(['like', 'Telefono', $this->Telefono]);

        return $dataProvider;
    }

}