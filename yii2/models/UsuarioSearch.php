<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

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
            [['idusuario', 'user_id'], 'integer'],
            [['nome', 'rg', 'cpf', 'cargo', 'reparticao', 'endereco', 'telefone', 'email', 'foto'], 'safe'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idusuario' => $this->idusuario,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'rg', $this->rg])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'reparticao', $this->reparticao])
            ->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }

    /***
     * @param $rg
     * @return array|null|\yii\db\ActiveRecord
     */
    public function searchUsuario($rg)
    {
        $query = Usuario::find()

            ->where(['rg'=>$rg])->one();
        if($query != null){
            return $query;
        }

        return null;

    }

    /***
     * @param $nomeUsuario
     * @return array|null|\yii\db\ActiveRecord[]
     */
    public function searchMatriculaUsuario($nomeUsuario)
    {
        $query = Usuario::find()->where(['like','nome',$nomeUsuario])->all();


        if($query != null){
            return $query;
        }
        return null;
    }

}
