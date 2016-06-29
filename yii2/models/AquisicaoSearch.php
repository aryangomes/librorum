<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aquisicao;

/**
 * AquisicaoSearch represents the model behind the search form about `app\models\Aquisicao`.
 */
class AquisicaoSearch extends Aquisicao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idaquisicao', 'tipo_aquisicao_idtipo_aquisicao', 'pessoa_idpessoa'], 'integer'],
            [['preco', 'quantidade'], 'safe'],
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
        $query = Aquisicao::find();

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
            'idaquisicao' => $this->idaquisicao,
            'tipo_aquisicao_idtipo_aquisicao' => $this->tipo_aquisicao_idtipo_aquisicao,
            'pessoa_idpessoa' => $this->pessoa_idpessoa,
        ]);

        $query->andFilterWhere(['like', 'preco', $this->preco])
            ->andFilterWhere(['like', 'quantidade', $this->quantidade]);

        return $dataProvider;
    }
}
