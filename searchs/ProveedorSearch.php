<?php
namespace app\searchs;

use app\models\Proveedor;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProveedorSearch extends Proveedor
{
    /*
     * Esta clase extiende del modelo mensionado y sirve para realizar las búsquedas dinámicas
     * dentro del GridView de la Vista PROVEEDORES
     */
    public function rules()
    {
        return [
            [
                [
                    'No_documento',
                    'cod_tipo_documento',
                    'Nombre',
                    'Apellido',
                    'direccion',
                    'Nombre_comercial',
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
        $query = Proveedor::find();
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
        $query->andFilterWhere(['like', 'No_documento', $this->No_documento]);
        $query->andFilterWhere(['like', 'tipo_de_documento.Descripcion', $this->cod_tipo_documento]);
        $query->andFilterWhere(['like', 'Nombre', $this->Nombre]);
        $query->andFilterWhere(['like', 'Apellido', $this->Apellido]);
        $query->andFilterWhere(['like', 'direccion', $this->direccion]);
        $query->andFilterWhere(['like', 'Nombre_comercial', $this->Nombre_comercial]);
        $query->andFilterWhere(['like', 'ciudad.Nombre_ciudad', $this->cod_ciudad]);
        $query->andFilterWhere(['like', 'Telefono', $this->Telefono]);

        return $dataProvider;
    }

}