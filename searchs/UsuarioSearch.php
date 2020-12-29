<?php

namespace app\searchs;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UsuarioSearch extends User
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
                    'id',
                    'username',
                    'password',
                    'authKey',
                    'accessToken',
                ], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find()->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        /*
         * Son los parámetros por el cual se puede realizar la búsqueda dentro del gridview
         */
        $query->andFilterWhere(['like', 'username', $this->username]);


        return $dataProvider;
    }

}
