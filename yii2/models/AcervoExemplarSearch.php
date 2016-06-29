<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AcervoExemplar;

/**
 * AcervoExemplarSearch represents the model behind the search form about `app\models\AcervoExemplar`.
 */
class AcervoExemplarSearch extends AcervoExemplar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idacervo_exemplar', 'acervo_idacervo'], 'integer'],
            [['codigo_livro'], 'safe'],
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
        $query = AcervoExemplar::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idacervo_exemplar' => $this->idacervo_exemplar,
            'acervo_idacervo' => $this->acervo_idacervo,
        ]);

        $query->andFilterWhere(['like', 'codigo_livro', $this->codigo_livro]);

        return $dataProvider;
    }
}
