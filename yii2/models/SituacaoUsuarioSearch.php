<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SituacaoUsuario;

/**
 * SituacaoUsuarioSearch represents the model behind the search form about `app\models\SituacaoUsuario`.
 */
class SituacaoUsuarioSearch extends SituacaoUsuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsituacao_usuario', 'pode_emprestar'], 'integer'],
            [['situacao'], 'safe'],
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
        $query = SituacaoUsuario::find();

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
            'idsituacao_usuario' => $this->idsituacao_usuario,
            'pode_emprestar' => $this->pode_emprestar,
        ]);

        $query->andFilterWhere(['like', 'situacao', $this->situacao]);

        return $dataProvider;
    }
}
