<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CategoriaAcervo;

/**
 * CategoriaAcervoSearch represents the model behind the search form about `app\models\CategoriaAcervo`.
 */
class CategoriaAcervoSearch extends CategoriaAcervo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcategoria_acervo'], 'integer'],
            [['categoria'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CategoriaAcervo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
              'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcategoria_acervo' => $this->idcategoria_acervo,
        ]);

        $query->andFilterWhere(['like', 'categoria', $this->categoria]);

        return $dataProvider;
    }
}
