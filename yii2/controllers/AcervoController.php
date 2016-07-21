<?php

namespace app\controllers;

use Yii;
use app\models\Acervo;
use app\models\AcervoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AcervoExemplar;
use app\models\Aquisicao;
use app\models\Pessoa;
use app\models\PessoaFisica;
use app\models\PessoaJuridica;
use yii\helpers\Json;
/**
 * AcervoController implements the CRUD actions for Acervo model.
 */
class AcervoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Acervo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcervoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acervo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Acervo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acervo();
        $aquisicao = new Aquisicao();
        $pessoa = new Pessoa();
        $pessoaFisica = new PessoaFisica();
        $pessoaJuridica = new PessoaJuridica();
        $tiposPessoa = ['1'=>'Pessoa Fisica','2'=>'Pessoa Juridica'];
/*        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idacervo]);*/
        


        if ((Yii::$app->request->post())){
            
            $post = Yii::$app->request->post();
            $dadosAquisicao = $post['Aquisicao'];
            $aquisicao->tipo_aquisicao_idtipo_aquisicao = $dadosAquisicao['tipo_aquisicao_idtipo_aquisicao'];
            $aquisicao->pessoa_idpessoa = $dadosAquisicao['pessoa_idpessoa'];
            $aquisicao->quantidade = $post['Acervo']['quantidadeExemplar'];
            $aquisicao->preco = $dadosAquisicao['preco'];
            
            $aquisicao->load($dadosAquisicao);

            if($aquisicao->save()){
            $model->load(Yii::$app->request->post());
            $model->aquisicao_idaquisicao =$aquisicao->idaquisicao;
            if($model->save()) {
                $quantidadeExemplares = Yii::$app->request->post()['Acervo']['quantidadeExemplar'];
                if($quantidadeExemplares > 0){
                    for($i = 1; $i <= $quantidadeExemplares; $i++){
                        $exemplar = new AcervoExemplar();
                        $exemplar->esta_disponivel = 1;
                        $exemplar->acervo_idacervo = $model->idacervo;
                        $exemplar->codigo_livro = $model->idacervo.''.$i;
                        
                        $exemplar->save(false);
                        if ($i == $quantidadeExemplares) {
                            return $this->redirect(['view', 'id' => $model->idacervo]);
                        }
                    }
                }
            }
        }
        } else {
            return $this->render('create', [
                'model' => $model,
                'aquisicao' => $aquisicao,
                'pessoa' => $pessoa,
                'pessoaFisica' => $pessoaFisica,
                'pessoaJuridica' => $pessoaJuridica,
                'tiposPessoa'=>$tiposPessoa,
            ]);
        }
    }

    /**
     * Updates an existing Acervo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $aquisicao = new Aquisicao();
        $pessoa = new Pessoa();
        $pessoaFisica = new PessoaFisica();
        $pessoaJuridica = new PessoaJuridica();
        $tiposPessoa = ['1'=>'Pessoa Fisica','2'=>'Pessoa Juridica'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idacervo]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'aquisicao' => $aquisicao,
                'pessoa' => $pessoa,
                'pessoaFisica' => $pessoaFisica,
                'pessoaJuridica' => $pessoaJuridica,
                'tiposPessoa'=>$tiposPessoa,
            ]);
        }
    }

    /**
     * Deletes an existing Acervo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetBuscaPessoa($nome)
    {
        $pessoa = Pessoa::find()->where(['nome' => $nome])->one();
        if($pessoa != null) {
            if(PessoaFisica::findOne($pessoa->idpessoa) != null) {
                $pessoaFisica = PessoaFisica::findOne($pessoa->idpessoa);
                echo Json::encode([$pessoaFisica->cpf, $pessoa,1]);
            } else if(PessoaJuridica::findOne($pessoa->idpessoa) != null) {
                $pessoaJuridica = PessoaJuridica::findOne($pessoa->idpessoa);
                echo Json::encode([$pessoaJuridica->cnpj, $pessoa,2]);
            } else {
                echo Json::encode(null);
            }
        }else{
             echo Json::encode(null);
        }
    }

    /**
     * Finds the Acervo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acervo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acervo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
