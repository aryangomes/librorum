<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acervo;

/**
 * AcervoSearch represents the model behind the search form about `app\models\Acervo`.
 */
class AcervoSearch extends Acervo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idacervo', 'aquisicao_idaquisicao', 'tipo_material_idtipo_material', 'categoria_acervo_idcategoria_acervo'], 'integer'],
            [['cdd', 'autor', 'titulo', 'editora', 'chamada'], 'safe'],
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
        $query = Acervo::find();

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
            'idacervo' => $this->idacervo,
            'aquisicao_idaquisicao' => $this->aquisicao_idaquisicao,
            'tipo_material_idtipo_material' => $this->tipo_material_idtipo_material,
            'categoria_acervo_idcategoria_acervo' => $this->categoria_acervo_idcategoria_acervo,
        ]);

        $query->andFilterWhere(['like', 'cdd', $this->cdd])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'editora', $this->editora])
            ->andFilterWhere(['like', 'chamada', $this->chamada]);

        return $dataProvider;
    }
    
     public function searchExemplares($idAcervo)
    {
        $query = AcervoExemplar::find()->where([
            'acervo_idacervo'=>$idAcervo
        ])->all();

        return $query;
    }
}
