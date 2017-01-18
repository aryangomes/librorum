<?php

namespace app\controllers;

use Yii;
use app\models\Acervo;
use app\models\AcervoSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AcervoExemplar;
use app\models\Aquisicao;
use app\models\Pessoa;
use app\models\PessoaFisica;
use app\models\PessoaJuridica;
use yii\helpers\Json;
use app\components\AccessFilter;
use yii\web\Session;

/**
 * AcervoController implements the CRUD actions for Acervo model.
 */
class AcervoController extends Controller
{

    protected $tiposPessoa = ['1' => 'Pessoa Física', '2' => 'Pessoa Jurídica'];

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'autorizacao' => [
                'class' => AccessFilter::className(),
                'actions' => [

                    'index' => 'acervo',
                    'update' => 'acervo',
                    'delete' => 'acervo',
                    'create' => 'acervo',
                    'view' => 'acervo',
                    'get-busca-pessoa' => 'acervo',
                    'gerar-novo-codigo-exemplares' => 'acervo',
                    'verifica-titulo-existe' => 'acervo',
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
        $acervoSearch = new AcervoSearch();
        $acervoExemplares = $acervoSearch->searchExemplares($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'acervoExemplares' => $acervoExemplares
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

        $mensagem = "";


        if ((Yii::$app->request->post())) {

            $catalogarAcervoExistente = Yii::$app->request->post()['Acervo']['catalogarAcervoExistente'];

            $post = Yii::$app->request->post();

            $dadosAquisicao = $post['Aquisicao'];

            $aquisicao->tipo_aquisicao_idtipo_aquisicao = $dadosAquisicao['tipo_aquisicao_idtipo_aquisicao'];

            $aquisicao->pessoa_idpessoa = $dadosAquisicao['pessoa_idpessoa'];

            $codigoExamplares = [];

            $mensagemSucesso =
                "Acervo catalogado com sucesso. Os códigos dos exemplares desse acervo são: ";

            if ($catalogarAcervoExistente) {
                $aquisicao->quantidade = intval($post['Acervo']['codigoFim']) - intval($post['Acervo']['codigoInicio']);
            } else {
                $aquisicao->quantidade = $post['Acervo']['quantidadeExemplar'];
            }

            $aquisicao->preco = $dadosAquisicao['preco'];


            //Inicia a transação:
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                if ($aquisicao->save(false)) {

                    $model->load(Yii::$app->request->post());
                    $model->aquisicao_idaquisicao = $aquisicao->idaquisicao;
                    if ($model->save()) {
                        if ($catalogarAcervoExistente) {

                            $codigoInicio = Yii::$app->request->post()['Acervo']['codigoInicio'];

                            $codigoFim = Yii::$app->request->post()['Acervo']['codigoFim'];

                            if ($codigoInicio > 0 && $codigoFim > 0) {

                                $count = 0;

                                $i = $codigoInicio;

                                while ($count <= ($codigoFim - $codigoInicio)) {

                                    $codigo = $i;

                                    if (!AcervoExemplar::verificaCodigoLivroExiste($codigo)) {

                                        $exemplar = new AcervoExemplar();

                                        $exemplar->esta_disponivel = 1;

                                        $exemplar->acervo_idacervo = $model->idacervo;

                                        $exemplar->codigo_livro = $codigo;

                                        $exemplar->save(false);

                                        array_push($codigoExamplares, $exemplar->codigo_livro);

                                        if ($count == ($codigoFim - $codigoInicio)) {

                                            $transaction->commit();

                                            $mensagemSucesso .= (implode(", ", $codigoExamplares));

                                            Yii::$app->session->setFlash('mensagem', $mensagemSucesso);


                                            return $this->redirect('create');
                                        }
                                        $i++;
                                        $count++;
                                    } else {
                                        $i++;
                                    }

                                }

                            }
                        } else {

                            $quantidadeExemplares = Yii::$app->request->post()['Acervo']['quantidadeExemplar'];
                            if ($quantidadeExemplares > 0) {

                                $count = 1;

                                $i = 1;

                                while ($count <= $quantidadeExemplares) {

                                    $codigo = $model->idacervo . '' . $i;

                                    if (!AcervoExemplar::verificaCodigoLivroExiste($codigo)) {

                                        $exemplar = new AcervoExemplar();

                                        $exemplar->esta_disponivel = 1;

                                        $exemplar->acervo_idacervo = $model->idacervo;

                                        $exemplar->codigo_livro = $model->idacervo . '' . $i;

                                        $exemplar->save(false);

                                        array_push($codigoExamplares, $exemplar->codigo_livro);

                                        if ($count == $quantidadeExemplares) {

                                            $transaction->commit();

                                            $mensagemSucesso .= (implode(", ", $codigoExamplares));

                                            Yii::$app->session->setFlash('mensagem', $mensagemSucesso);

                                            return $this->redirect('create');
                                        }

                                        $i++;

                                        $count++;
                                    } else {

                                        $i++;
                                    }

                                }
                            }
                        }
                    }
                }

            } catch (\Exception $exception) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('mensagem', "Ocorreu uma falha inesperada ao tentar 
                catalogar o Acervo");

            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'aquisicao' => $aquisicao,
                'pessoa' => $pessoa,
                'pessoaFisica' => $pessoaFisica,
                'pessoaJuridica' => $pessoaJuridica,
                'tiposPessoa' => $this->tiposPessoa,
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

        $aquisicao = Aquisicao::findOne($model->aquisicao_idaquisicao);

        $pessoa = Pessoa::findOne($aquisicao->pessoa_idpessoa);

        $pessoaFisica = PessoaFisica::findOne($pessoa->idpessoa) != null ?
            PessoaFisica::findOne($pessoa->idpessoa) : new PessoaFisica();

        $pessoaJuridica = PessoaJuridica::findOne($pessoa->idpessoa) != null ?
            PessoaJuridica::findOne($pessoa->idpessoa) : new PessoaJuridica();


        $tipoPessoa = (($pessoaFisica->pessoa_idpessoa) != null) ? $this->tiposPessoa['1'] : $this->tiposPessoa['2'];


        if ($model->load(Yii::$app->request->post())) {

            $dadosAquisicao = (Yii::$app->request->post()['Aquisicao']);

            $aquisicao->tipo_aquisicao_idtipo_aquisicao = $dadosAquisicao['tipo_aquisicao_idtipo_aquisicao'];

            $aquisicao->pessoa_idpessoa = $dadosAquisicao['pessoa_idpessoa'];

            $aquisicao->preco = $dadosAquisicao['preco'];

            $transaction = \Yii::$app->db->beginTransaction();
            try {

                if ($aquisicao->save(false) && $model->save()) {
                    $transaction->commit();

                    Yii::$app->session->setFlash('mensagem', "Acervo atualizado com sucesso");

                    return $this->redirect(['view', 'id' => $model->idacervo]);
                }

            } catch (\Exception $exception) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('mensagem', "Ocorreu uma falha inesperada ao tentar 
                catalogar o Acervo");

            }


        } else {
            return $this->render('update', [
                'model' => $model,
                'aquisicao' => $aquisicao,
                'pessoa' => $pessoa,
                'pessoaFisica' => $pessoaFisica,
                'pessoaJuridica' => $pessoaJuridica,
                'tiposPessoa' => $this->tiposPessoa,
                'tipoPessoa' => $tipoPessoa,
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
        $transaction = \Yii::$app->db->beginTransaction();

        $modelEmprestimo = $this->findModel($id);

        $aquisicao = Aquisicao::findOne($modelEmprestimo->aquisicao_idaquisicao);

        if ($aquisicao != null) {
            try {

                if ($aquisicao->delete()) {
                    $transaction->commit();

                    Yii::$app->session->setFlash('mensagem', "Acervo excluído com sucesso");
                }

            } catch (\Exception $exception) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('mensagem', "Ocorreu uma falha inesperada ao tentar 
                excluir o Acervo");

            }

        }

        return $this->redirect(['index']);
    }

    /**
     * Busca e retorna a pessoa da aquisição
     * @param $nome
     */
    public function actionGetBuscaPessoa($nome)
    {
        $pessoa = Pessoa::find()->where(['nome' => $nome])->one();
        if ($pessoa != null) {

            if (PessoaFisica::findOne($pessoa->idpessoa) != null) {

                $pessoaFisica = PessoaFisica::findOne($pessoa->idpessoa);

                echo Json::encode([$pessoaFisica->cpf, $pessoa, 1]);

            } else if (PessoaJuridica::findOne($pessoa->idpessoa) != null) {

                $pessoaJuridica = PessoaJuridica::findOne($pessoa->idpessoa);

                echo Json::encode([$pessoaJuridica->cnpj, $pessoa, 2]);

            } else {
                echo Json::encode(null);
            }
        } else {
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


    /**
     * Gera novos códigos de exemplares para o acervo
     * @param $id
     *
     */
    public function actionGerarNovoCodigoExemplares($id)
    {

        if (Yii::$app->request->post()) {


            $mensagem = "";

            $session = Yii::$app->session;

            $transaction = \Yii::$app->db->beginTransaction();

            $aquisicao = Aquisicao::findOne($this->findModel($id)->aquisicao_idaquisicao);

            try {


                $exemplaresExcluidos = AcervoExemplar::deleteAll(
                    ['acervo_idacervo' => $id]);

                if ($exemplaresExcluidos > 0) {


                    $itensInseridos = true;

                    $catalogarAcervoExistente = Yii::$app->request->post()['Acervo']['catalogarAcervoExistente'];

                    if ($catalogarAcervoExistente) {
                        $codigoInicio = Yii::$app->request->post()['Acervo']['codigoInicio'];


                        $codigoFim = Yii::$app->request->post()['Acervo']['codigoFim'];

                        if ($codigoInicio > 0 && $codigoFim > 0) {

                            $count = 0;

                            $i = $codigoInicio;

                            while ($count <= ($codigoFim - $codigoInicio)) {

                                $codigo = $i;

                                if (!AcervoExemplar::verificaCodigoLivroExiste($codigo)) {
                                    $exemplar = new AcervoExemplar();

                                    $exemplar->esta_disponivel = 1;

                                    $exemplar->acervo_idacervo = $id;

                                    $exemplar->codigo_livro = $codigo;

                                    if (!$exemplar->save(false)) {

                                        $itensInseridos = false;

                                        $count = ($codigoFim - $codigoInicio);

                                        break;

                                    }

                                    if ($count == ($codigoFim - $codigoInicio)) {
                                        if (!$itensInseridos) {

                                            $transaction->rollBack();

                                            $mensagem = "Não foi possível gerar novos códigos";

                                            $session->setFlash('erro', $mensagem);
                                        } else {

                                            $aquisicao->quantidade = ($count + 1);

                                            $aquisicao->save(false);

                                            $transaction->commit();

                                            Yii::$app->session->setFlash('mensagem', "Novo(s) código(s) gerado(s)");
                                        }
                                        return $this->redirect(['view', 'id' => $id]);

                                    }
                                    $i++;
                                    $count++;
                                } else {
                                    $i++;
                                }

                            }

                        } else {
                            $transaction->rollBack();

                            $mensagem = "<b>Erro! </b>Digite os código de inicio e fim.";
                            $session->setFlash('erro', $mensagem);

                            return $this->redirect(['view', 'id' => $id]);
                        }
                    } else {
                        $quantidadeExemplares = Yii::$app->request->post()['Acervo']['quantidadeExemplar'];
                        if ($quantidadeExemplares > 0) {

                            $count = 1;
                            $i = 1;
                            while ($count <= $quantidadeExemplares) {
                                $codigo = $id . '' . $i;
                                if (!AcervoExemplar::verificaCodigoLivroExiste($codigo)) {
                                    $exemplar = new AcervoExemplar();

                                    $exemplar->esta_disponivel = 1;

                                    $exemplar->acervo_idacervo = $id;

                                    $exemplar->codigo_livro = $id . '' . $i;


                                    if (!$exemplar->save()) {
                                        $itensInseridos = false;
                                        $count = $quantidadeExemplares;
                                        break;
                                    }

                                    if ($count == $quantidadeExemplares) {

                                        if (!$itensInseridos) {
                                            $transaction->rollBack();

                                            $mensagem = "Não foi possível gerar novos códigos.";

                                            $session->setFlash('erro', $mensagem);
                                        } else {

                                            $aquisicao->quantidade = $quantidadeExemplares;

                                            $aquisicao->save();

                                            $transaction->commit();

                                            Yii::$app->session->setFlash('mensagem', "Novo(s) código(s) gerado(s)");
                                        }
                                        return $this->redirect(['view', 'id' => $id]);

                                    }
                                    $i++;
                                    $count++;
                                } else {
                                    $i++;
                                }

                            }
                        } else {
                            $transaction->rollBack();
                            $mensagem = " <b>Erro! </b>Digite a quantidade de exemplares";
                            $session->setFlash('erro', $mensagem);
                            return $this->redirect(['view', 'id' => $id]);
                        }
                    }

                } else {
                    $transaction->rollBack();
                    $mensagem = "Não foi possível gerar novos códigos";
                    $session->setFlash('erro', $mensagem);
                    return $this->redirect(['view', 'id' => $id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                $mensagem = "Não foi possível gerar novos códigos";
                $session->setFlash('erro', $mensagem);
                return $this->redirect(['view', 'id' => $id]);
            }
        }

    }

    /**
     * Verifica se um título de acervo já existe
     * @param $acervoTitulo
     */
    public function actionVerificaTituloExiste($acervoTitulo)
    {
        $acervo = Acervo::find()->where([
            'titulo' => $acervoTitulo
        ])->one();

        if ($acervo != null) {
            echo Json::encode(true);
        } else {

            echo Json::encode(false);
        }
    }

}
