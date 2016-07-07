<?php

namespace app\models;

use app\models\Usuario;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idusuario'], 'integer'],
            [['nome', 'rg', 'cpf', 'cargo', 'reparticao', 'endereco', 'telefone', 'email'], 'safe'],
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
        $query = Usuario::find();

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
            'idusuario' => $this->idusuario,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'rg', $this->rg])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'reparticao', $this->reparticao])
            ->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }


    public function searchMatriculaUsuario($nomeUsuario)
    {
        $query = Usuario::find()->where(['like','nome',$nomeUsuario])->all();


        return $query;
    }
}
