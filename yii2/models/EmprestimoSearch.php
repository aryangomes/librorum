<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Emprestimo;

/**
 * EmprestimoSearch represents the model behind the search form about `app\models\Emprestimo`.
 */
class EmprestimoSearch extends Emprestimo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idemprestimo', 'usuario_idusuario', 'acervo_exemplar_idacervo_exemplar'], 'integer'],
            [['dataemprestimo', 'dataprevisaodevolucao', 'datadevolucao', 'usuario_nome', 'usuario_rg'], 'safe'],
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
        $query = Emprestimo::find();

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
            'idemprestimo' => $this->idemprestimo,
            'dataemprestimo' => $this->dataemprestimo,
            'dataprevisaodevolucao' => $this->dataprevisaodevolucao,
            'datadevolucao' => $this->datadevolucao,
            'usuario_idusuario' => $this->usuario_idusuario,
            'acervo_exemplar_idacervo_exemplar' => $this->acervo_exemplar_idacervo_exemplar,
        ]);

        $query->andFilterWhere(['like', 'usuario_nome', $this->usuario_nome])
            ->andFilterWhere(['like', 'usuario_rg', $this->usuario_rg]);

        return $dataProvider;
    }
}
