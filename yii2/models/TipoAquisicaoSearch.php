<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoAquisicao;

/**
 * TipoAquisicaoSearch represents the model behind the search form about `app\models\TipoAquisicao`.
 */
class TipoAquisicaoSearch extends TipoAquisicao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtipo_aquisicao'], 'integer'],
            [['nome'], 'safe'],
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
        $query = TipoAquisicao::find();

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

        $query->andFilterWhere([
            'idtipo_aquisicao' => $this->idtipo_aquisicao,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}
