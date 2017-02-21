<?php

namespace app\controllers;

use amnah\yii2\user\models\User;
use app\models\Acervo;
use app\models\AcervoExemplar;
use app\models\AcervoExemplarSearch;
use app\models\EmprestimoHasAcervoExemplar;
use app\models\Usuario;
use app\models\UsuarioSearch;
use Yii;
use app\models\Emprestimo;
use app\models\EmprestimoSearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\Config;
use kartik\mpdf\Pdf;
use app\components\AccessFilter;

/**
 * EmprestimoController implements the CRUD actions for Emprestimo model.
 */
class EmprestimoController extends Controller
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
            'autorizacao' => [
                'class' => AccessFilter::className(),
                'actions' => [

                    'index' => 'emprestimo',
                    'update' => 'emprestimo',
                    'delete' => 'emprestimo',
                    'create' => 'emprestimo',
                    'view' => 'emprestimo',
                    'validar-senha' => 'emprestimo',
                    'get-usuario' => 'emprestimo',
                    'devolucao' => 'emprestimo',
                    'get-busca-usuario' => 'emprestimo',
                    'get-exemplar' => 'emprestimo',
                    'get-data-previsao-devolucao' => 'emprestimo',
                    'get-busca-exemplar' => 'emprestimo',
                    'renovar' => 'emprestimo',
                    'verifica-pode-emprestar' => 'emprestimo',
                    'configurar-dias-emprestimo' => 'emprestimo',
                    'get-busca-emprestimo-rg' => 'emprestimo',
                    'get-busca-emprestimo-codigo-exemplar' => 'emprestimo',
                    'gerar-comprovante-emprestimo' => 'emprestimo',
                    'get-busca-emprestimo' => 'emprestimo',
                    'emprestimos-sem-devolucao' => 'emprestimo',
                ],
            ],
        ];
    }

    /**
     * Lists all Emprestimo models.
     * @return mixed
     */
    public function actionIndex($situacaoEmprestimo = '')
    {
        $searchModel = new EmprestimoSearch();

        if (Yii::$app->request->get()) {
            $situacaoEmprestimo = Yii::$app->request->get()['situacao-emprestimo'];
        }
        $dataProvider = $searchModel->searchIndexEmprestimo($situacaoEmprestimo);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'situacaoEmprestimo' => $situacaoEmprestimo,
        ]);
    }

    /**
     * Displays a single Emprestimo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        //Seta os dias de diferença entre o dia do empréstimo e a data atual
        $model->calcularDiasDeEmprestimo();

        $searchModel = new EmprestimoSearch();

        $exemplaresEmprestados = null;

        if ($searchModel->searchDadosEmprestimo($id) != null) {
            $exemplaresEmprestados = $searchModel->searchDadosEmprestimo($id)["acervoExemplarIdacervoExemplars"];
        }


        return $this->render('view', [
            'model' => $model,
            'exemplaresEmprestados' => $exemplaresEmprestados
        ]);
    }

    /**
     * Creates a new Emprestimo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //Setando a data para o fuso do Brasil
        date_default_timezone_set('America/Recife');

        $model = new Emprestimo();

        $usuario = new Usuario();

        $acervo = new Acervo();

        $exemplar = new AcervoExemplar();

        $user = new User();

        $maxQtdExemplarEmprestimo = \app\models\Config::findOne('max_qtd_exemplar_emprestimo')['valor'];

        if (Yii::$app->session->hasFlash('mensagemSucesso')) {

            $mensagem = Yii::$app->session->getFlash('mensagemSucesso');

        } else {

            $mensagem = "";
        }


        $situacoesusuario = \yii\helpers\ArrayHelper::map(
            \app\models\SituacaoUsuario::find()->all(), 'idsituacao_usuario', 'situacao');

        $user->setScenario("admin");


        $user->role_id = 2;

        $user->status = 1;


        $model->dataemprestimo = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {

            //Inicia a transação:
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                if ($model->save()) {

                    $itensSalvos = true;

                    $codigosExemplares = Yii::$app->request->post()['AcervoExemplar']['codigo_livro'];

                    foreach ($codigosExemplares as $codExem) {

                        if (!empty($codExem)) {

                            $modelEmprestimoHasAcervoExemplar = new EmprestimoHasAcervoExemplar();

                            $exemplar = AcervoExemplar::find()->where(['codigo_livro' => $codExem])->one();

                            if ($exemplar != null) {

                                if ($exemplar->esta_disponivel == 0) {
                                    $itensSalvos = false;

                                    $mensagem = "Exemplar " . $exemplar->acervoIdacervo->titulo
                                        . ' está indisponível';
                                    break;
                                } else {

                                    $exemplar->esta_disponivel = 0;

                                    $modelEmprestimoHasAcervoExemplar->emprestimo_idemprestimo = $model->idemprestimo;

                                    $modelEmprestimoHasAcervoExemplar->acervo_exemplar_idacervo_exemplar = $exemplar->idacervo_exemplar;

                                    if (!($exemplar->save()) || !($modelEmprestimoHasAcervoExemplar->save())) {
                                        $itensSalvos = false;
                                        break;
                                    }
                                }

                            } else {
                                $itensSalvos = false;
                                break;
                            }
                        }
                    }

                    if ($itensSalvos) {
                        $transaction->commit();

                        $mensagem = "Empréstimo cadastrado com sucesso. 
                    <a href='" . Url::to(['view', 'id' => $model->idemprestimo]) . "' target='_blank'>Clique aqui para acessá-lo!</a>";

                        Yii::$app->session->setFlash('mensagemSucesso', $mensagem);

                        return $this->redirect(['create']);
                    }
                }


                return $this->render('create', [
                    'model' => $model,
                    'usuario' => $usuario,
                    'acervo' => $acervo,
                    'exemplar' => $exemplar,
                    'user' => $user,
                    'situacoesusuario' => $situacoesusuario,
                    'mensagem' => $mensagem,
                    'maxQtdExemplarEmprestimo' => $maxQtdExemplarEmprestimo,
                ]);


            } catch (\Exception $exception) {
                $transaction->rollBack();
                $mensagem = "Ocorreu uma falha inesperada ao tentar salvar o Empréstimo";
            }


        } else {
            return $this->render('create', [
                'model' => $model,
                'usuario' => $usuario,
                'acervo' => $acervo,
                'exemplar' => $exemplar,
                'user' => $user,
                'situacoesusuario' => $situacoesusuario,
                'mensagem' => $mensagem,
                'maxQtdExemplarEmprestimo' => $maxQtdExemplarEmprestimo,
            ]);
        }
    }


    /**
     * Realiza a devolução do empréstimo
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDevolucao($id)
    {
        $model = $this->findModel($id);

        $mensagemSucesso = "Exemplar(es) devolvido com sucesso";


        if ((Yii::$app->request->post())) {
            $model->datadevolucao = date('Y-m-d H:i:s');

            $acervoExemplares = EmprestimoHasAcervoExemplar::find()->
            where(['emprestimo_idemprestimo' => $id])->all();

            //Inicia a transação:
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                $itensSalvos = true;

                if ($model->save()) {

                    foreach ($acervoExemplares as $exemplar) {
                        $exemplar = AcervoExemplar::findOne($exemplar['acervo_exemplar_idacervo_exemplar']);

                        $exemplar->esta_disponivel = 1;

                        if (!($exemplar->save())) {
                            $itensSalvos = false;
                            break;
                        }
                    }

                }

                if ($itensSalvos) {
                    $transaction->commit();

                    Yii::$app->session->setFlash('mensagemDevolucaoSucesso', $mensagemSucesso);

                    return $this->redirect(['/']);
                }


            } catch (\Exception $exception) {
                $transaction->rollBack();
                $mensagem = "Ocorreu uma falha inesperada ao tentar salvar o Empréstimo";


                return $this->redirect(['view', 'id' => $id]);
            }


        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Emprestimo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //Inicia a transação:
        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $exemplaresEmprestimo = EmprestimoHasAcervoExemplar::find()
                ->where(['emprestimo_idemprestimo' => $id])
                ->all();

            $itensDeletados = true;

            foreach ($exemplaresEmprestimo as $exemplar) {

                $exemplar = AcervoExemplar::findOne($exemplar["acervo_exemplar_idacervo_exemplar"]);

                if ($exemplar != null) {

                    $exemplar->esta_disponivel = 1;

                    if (!($exemplar->save())) {
                        $itensDeletados = false;
                        break;
                    }
                } else {
                    $itensDeletados = false;
                    break;
                }

            }

            if ($itensDeletados && $model->delete()) {
                $transaction->commit();

                Yii::$app->session->setFlash('mensagemCanceladoSucesso', 'Empréstimo cancelado com sucesso');

                return $this->redirect(['/']);
            }

        } catch (\Exception $exception) {
            $transaction->rollBack();
            $mensagem = "Ocorreu uma falha inesperada ao tentar salvar o Empréstimo";
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emprestimo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emprestimo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emprestimo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Retorna JSON com os dados do Usuário de acordo com o Login passado
     * @param $login
     * Return Json
     */
    public function actionGetUsuario($rg)
    {
        $modelSearch = new UsuarioSearch();
        $usuario = $modelSearch->searchUsuario($rg);


        echo Json::encode($usuario);
    }

    public function actionValidarSenha($user_id, $senha)
    {
        $user = User::findIdentity($user_id);
        if ($user != null && $user->validatePassword($senha)) {
            echo Json::encode(true);
        } else {
            echo Json::encode(false);
        }
    }

    /**
     * Retorna JSON com os dados do Usuário de acordo com o Nome do Usuário passado
     * @param $login
     * Return Json
     */
    public function actionGetBuscaUsuario($nomeUsuario)
    {
        $modelSearch = new UsuarioSearch();

        $usuarios = $modelSearch->searchMatriculaUsuario($nomeUsuario);

        if ($usuarios != null) {

            $usuario = [];

            foreach ($usuarios as $u) {

                array_push($usuario, $u);

            }
            echo Json::encode($usuario);
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Retorna JSON com os dados do Exemplar de acordo com o Login passado
     * @param $idExemplar
     * Return Json
     */
    public function actionGetExemplar($codigoExemplar)
    {
        $exemplar = AcervoExemplar::find()
            ->joinWith('acervoIdacervo')
            ->where(['codigo_livro' => $codigoExemplar])->one();

        if ($exemplar != null) {
            echo Json::encode([$exemplar, $exemplar['acervoIdacervo']]);
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Retorna a data de previsão de devolução do empréstimo
     */
    public function actionGetDataPrevisaoDevolucao()
    {
        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Recife');

        $dias_emprestimo = \app\models\Config::findOne('dias_emprestimo');

        if ($dias_emprestimo != null) {

            $dataprevisao = date('Y-m-d H:i:s', strtotime("+" . $dias_emprestimo->valor . " days"));

            $dataprevisaoformatado = date('d/m/Y H:i:s', strtotime("+" . $dias_emprestimo->valor . " days"));

            echo Json::encode([$dataprevisao, $dataprevisaoformatado]);
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Busca um exemplar pelo título informado
     * @param $tituloExemplar
     */
    public function actionGetBuscaExemplar($tituloExemplar)
    {
        $modelSearch = new AcervoExemplarSearch();

        $exemplares = $modelSearch->searchExemplarByTitulo($tituloExemplar);

        $exemplar = [];

        $auxexemplar = [];

        foreach ($exemplares as $e) {

            array_push($exemplar, $e);

            array_push($auxexemplar, $e['acervoIdacervo']);
        }

        if (count($exemplar) <= 0) {
            echo Json::encode(0);
        } else {

            echo Json::encode([$exemplar, $auxexemplar]);
        }
    }

    /**
     * Realiza a renovação do empréstimo
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionRenovar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->dataprevisaodevolucao = date("Y-m-d H:i:s", strtotime(Yii::$app->request->post()['Emprestimo']['dataprevisaodevolucao']));

            if ($model->save()) {
                Yii::$app->session->setFlash('mensagemRenovadoSucesso', 'Empréstimo renovado com sucesso');

                return $this->redirect(['/', 'msg' => 'mensagemDevolucaoSucesso']);

            }

            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Retorna se um usuário pode ou não realizar empréstimo
     * @param $idusuario
     */
    public function actionVerificaPodeEmprestar($idusuario)
    {
        $usuario = Usuario::findOne($idusuario);


        if ($usuario != null) {
            $pode_emprestar = $usuario->verificarPodeEmprestar();

            if ($pode_emprestar) {
                $searchUsuario = new UsuarioSearch();

                $qtdExemplaresEmprestados = $searchUsuario->searchQtdExemplaresEmprestados($idusuario);

                $maxQtdExemplarEmprestimo = \app\models\Config::findOne('max_qtd_exemplar_emprestimo')['valor'];

                if ($qtdExemplaresEmprestados >= $maxQtdExemplarEmprestimo) {

                    echo Json::encode('maxQtdExemplarEmprestimo');
                } else {
                    echo ($qtdExemplaresEmprestados);
                }

            } else {
                echo Json::encode(false);
            }
        } else {
            echo Json::encode(false);
        }
    }

    /**
     * Configura o dias de um empréstimo
     * @param $diasEmprestimo
     */
    public function actionConfigurarDiasEmprestimo($diasEmprestimo)
    {
        $config = new Config();
        if ($diasEmprestimo != null && intval($diasEmprestimo) > 0) {
            $config->chave = 'dias_emprestimo';
            $config->valor = $diasEmprestimo;
            if ($config->save()) {

                echo Json::encode(true);
            } else {
                echo Json::encode(false);
            }
        } else {
            echo Json::encode(false);
        }
    }

    /**
     * Busca um empréstimo dado um RG de um usuário
     * @param $rg
     */
    public function actionGetBuscaEmprestimoRg($rg)
    {
        $modelSearch = new EmprestimoSearch();

        $emprestimos = $modelSearch->searchEmprestimoByRg($rg);

        $arrayDiasDiferenca = [];

        if ($emprestimos != null) {

            $emprestimoExemplares = [];

            $emprestimoUsuario = [];

            foreach ($emprestimos as $key => $e) {

                $emprestimos[$key]->calcularDiasDeEmprestimo();

                array_push($arrayDiasDiferenca, $e->diasDiferenca);

                $emprestimos[$key]->dataprevisaodevolucao = (date("d/m/Y", strtotime($e->dataprevisaodevolucao)));

                $emprestimos[$key]->dataemprestimo = (date("d/m/Y H:i", strtotime($e->dataemprestimo)));

            }

            foreach ($emprestimos as $e) {

                $exemplaresEmprestados = $e['emprestimoHasAcervoExemplars'];


                foreach ($exemplaresEmprestados as $ee) {

                    array_push($emprestimoExemplares, [

                        $ee['acervoExemplarIdacervoExemplar'],
                        $ee['acervoExemplarIdacervoExemplar']['acervoIdacervo']
                    ]);
                }

            }

            foreach ($emprestimos as $e) {

                array_push($emprestimoUsuario, $e['usuarioIdusuario']);
            }


            if ($emprestimos != null) {

                echo Json::encode([$emprestimos, $emprestimoUsuario, $emprestimoExemplares,
                    $arrayDiasDiferenca]);
            } else {
                echo Json::encode(null);
            }
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Busca um empréstimo dado um Código de um exemplar
     * @param $codigoExemplar
     */
    public function actionGetBuscaEmprestimoCodigoExemplar($codigoExemplar)
    {
        $modelSearch = new EmprestimoSearch();

        $emprestimo = $modelSearch->searchEmprestimoByCodigoExemplar($codigoExemplar);

        if ($emprestimo != null) {

            $emprestimoExemplares = [];

            $emprestimoUsuario = [];

            foreach ($emprestimo as $key => $e) {

                $emprestimo[$key]->dataprevisaodevolucao = (date("d/m/Y", strtotime($e->dataprevisaodevolucao)));

                $emprestimo[$key]->dataemprestimo = (date("d/m/Y H:i", strtotime($e->dataemprestimo)));
            }
            foreach ($emprestimo as $e) {

                array_push($emprestimoExemplares, $e['acervoExemplarIdacervoExemplars'][0]['acervoIdacervo']);
            }
            foreach ($emprestimo as $e) {

                array_push($emprestimoUsuario, $e['usuarioIdusuario']);
            }
            if ($emprestimo != null) {

                echo Json::encode([$emprestimo, $emprestimoUsuario, $emprestimoExemplares]);
            } else {
                echo Json::encode(null);
            }
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Gera um PDF com o compravante de empréstimo
     * @param $id
     * @return mixed
     */
    public function actionGerarComprovanteEmprestimo($id)
    {

        //Setando a data para o fuso do Brasil
        date_default_timezone_set('America/Recife');

        $emprestimoSearch = new EmprestimoSearch();

        $dadosEmprestimo = $emprestimoSearch->searchDadosEmprestimo($id);

        $configSearch = new \app\models\ConfigSearch();

        $config = $configSearch->searchConfig('nome_biblioteca');

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'content' => $this->renderPartial('comprovante', [
                'dadosEmprestimo' => $dadosEmprestimo,
                'config' => $config
            ]),
            'filename' => 'comprovanteemprestimo' .
                date("d-m-Y_H-i-s", strtotime
                ($dadosEmprestimo->dataemprestimo)) . '.pdf',
            'options' => [
                'title' => 'Comprovante de Empréstimo',
            ],
            'methods' => [
                'SetHeader' => ['Gerado por: Krajee Pdf Component||Gerado em: ' .
                    date("d/m/Y H:i:s")],
                'SetFooter' => ['|Página{PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }


    /**
     * Busca e retorna todos os dados de um empréstimo
     * @param $id
     */
    public function actionGetBuscaEmprestimo($id)
    {
        $modelSearch = new EmprestimoSearch();

        $emprestimo = $modelSearch->searchDadosEmprestimo($id);

        $arrayDiasDiferenca = [];

        if ($emprestimo != null) {

            $emprestimoExemplares = [];

            $emprestimoUsuario = [];


            $emprestimo->calcularDiasDeEmprestimo();

            array_push($arrayDiasDiferenca, $emprestimo->diasDiferenca);

            $emprestimo->dataprevisaodevolucao = (date("d/m/Y", strtotime($emprestimo->dataprevisaodevolucao)));

            $emprestimo->dataemprestimo = (date("d/m/Y H:i", strtotime($emprestimo->dataemprestimo)));

            $exemplaresEmprestados = $emprestimo['acervoExemplarIdacervoExemplars'];


            foreach ($exemplaresEmprestados as $ee) {

                array_push($emprestimoExemplares, [

                    $ee,
                    $ee['acervoIdacervo']
                ]);
            }


            array_push($emprestimoUsuario, $emprestimo['usuarioIdusuario']);


            if ($emprestimo != null) {

                echo Json::encode([$emprestimo, $emprestimoUsuario, $emprestimoExemplares,
                    $arrayDiasDiferenca]);
            } else {
                echo Json::encode(null);
            }
        } else {
            echo Json::encode(null);
        }
    }

    /**
     * Retorna os empréstimo que não foram devolvidos
     * @return string
     */
    public function actionEmprestimosSemDevolucao()
    {
        $searchModel = new EmprestimoSearch();

        $dataProvider = $searchModel->searchUsuariosQueNaoFizeramDevolucao();

        return $this->render('emprestimossemdevolucao', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);


    }

}
