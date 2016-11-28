<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Relatorio;

/**
 * RelatorioSearch represents the model behind the search form about `app\models\Relatorio`.
 */
class RelatorioSearch extends Relatorio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrelatorio'], 'integer'],
            [['tipo', 'inicio_intervalo', 'fim_intervalo', 'data_geracao'], 'safe'],
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
        $query = Relatorio::find();

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
            'idrelatorio' => $this->idrelatorio,
            'inicio_intervalo' => $this->inicio_intervalo,
            'fim_intervalo' => $this->fim_intervalo,
            'data_geracao' => $this->data_geracao,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }

    /**
     * @param $inicioIntervalo
     * @param $fimIntervalo
     * @return array
     */
    public function searchRelatorioEmprestimos($inicioIntervalo, $fimIntervalo)
    {
        //Procura e guarda as datas que tivem empréstimos de acordo com o intervalo
        //passado
        $query = Emprestimo::find()->select("*")
            ->where(['between', 'dataemprestimo', $inicioIntervalo, $fimIntervalo])->orderBy('dataemprestimo ASC')
            ->groupBy('DATE_FORMAT(dataemprestimo, "%Y-%-%d`")');

        //Guarda as datas num array
        $datas = [];

        //Guarda a quantidade de empréstimo por data num array
        $qtdEmprestimosPorData = [];

        foreach ($query->all() as $i) {

            $data = (date('Y-m-d',strtotime($i->dataemprestimo)));


            //Busca todos os empréstimo feitos naquela data
            $query = Emprestimo::find()
                ->where(['between', 'dataemprestimo', $data.' 00:00:00',  $data.' 23:59:59'])
                ->all();

            array_push($qtdEmprestimosPorData, count($query));

            $data = (date('d/m/Y',strtotime($i->dataemprestimo)));

            array_push($datas, $data);

        }

        return [$datas, $qtdEmprestimosPorData];
    }


    /**
     * @param $inicioIntervalo
     * @param $fimIntervalo
     * @return array
     */
    public function searchRelatorioDevolucoes($inicioIntervalo, $fimIntervalo)
    {
        //Procura e guarda as datas que tivem empréstimos de acordo com o intervalo
        //passado
        $query = Emprestimo::find()->select("*")
            ->where(['between', 'dataemprestimo', $inicioIntervalo, $fimIntervalo])
            ->andFilterWhere(['<>','datadevolucao','is null'])
            ->orderBy('dataemprestimo ASC')
            ->groupBy('DATE_FORMAT(dataemprestimo, "%Y-%-%d`")');

        //Guarda as datas num array
        $datas = [];

        //Guarda a quantidade de devoluções por data num array
        $qtdDevolucoesPorData = [];

        foreach ($query->all() as $i) {

            $data = (date('Y-m-d',strtotime($i->dataemprestimo)));


            //Busca todos os devoluções feitos naquela data
            $query = Emprestimo::find()
                ->where(['between', 'dataemprestimo', $data.' 00:00:00',  $data.' 23:59:59'])
                ->all();

            array_push($qtdDevolucoesPorData, count($query));

            $data = (date('d/m/Y',strtotime($i->dataemprestimo)));

            array_push($datas, $data);

        }

        return [$datas, $qtdDevolucoesPorData];
    }
}
