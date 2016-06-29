<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PessoaFisica;

/**
 * PessoaFisicaSearch represents the model behind the search form about `app\models\PessoaFisica`.
 */
class PessoaFisicaSearch extends PessoaFisica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf'], 'safe'],
            [['pessoa_idpessoa'], 'integer'],
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
        $query = PessoaFisica::find();

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
            'pessoa_idpessoa' => $this->pessoa_idpessoa,
        ]);

        $query->andFilterWhere(['like', 'cpf', $this->cpf]);

        return $dataProvider;
    }
}
