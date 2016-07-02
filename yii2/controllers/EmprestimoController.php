<?php

namespace app\controllers;

use app\models\Acervo;

use app\models\AcervoExemplar;
use app\models\Usuario;
use Yii;
use app\models\Emprestimo;
use app\models\EmprestimoSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        ];
    }

    /**
     * Lists all Emprestimo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmprestimoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emprestimo model.
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
     * Creates a new Emprestimo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emprestimo();
        $usuario = new Usuario();
        $acervo = new Acervo();
        $exemplar = new AcervoExemplar();
        
        //Definindo a data de Empréstimo
        date_default_timezone_set('America/Sao_Paulo');
        $model->dataemprestimo = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idemprestimo]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'usuario'=>$usuario,
                'acervo'=>$acervo,
                'exemplar'=>$exemplar
            ]);
        }
    }

    /**
     * Updates an existing Emprestimo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usuario = Usuario::findOne([$model->usuario_idusuario,$model->usuario_rg,$model->usuario_nome]);
        $acervo = Acervo::findOne([$model->acervo_exemplar_idacervo_exemplar]);
        $exemplar = AcervoExemplar::findOne([$model->acervo_exemplar_idacervo_exemplar]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idemprestimo]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'usuario'=>$usuario,
                'acervo'=>$acervo,
                'exemplar'=>$exemplar
            ]);
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDevolucao($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->datadevolucao =date("Y-m-d H:i:s",
                strtotime(Yii::$app->request->post()['Emprestimo']['datadevolucao']));

            if( $model->save()){
                return $this->redirect(['view', 'id' => $id]);
            }
            return $this->redirect(['view', 'id' => $id]);

        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Emprestimo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
       /* $modelSearch = new UsuariosSearch();
        $usuario = $modelSearch->searchUsuario($matricula);*/

        $usuario = Usuario::find()->where(['rg'=>$rg])->one();

        echo Json::encode($usuario);

    }


    /**
     * Retorna JSON com os dados do Usuário de acordo com o Nome do Usuário passado
     * @param $login
     * Return Json
     */
    public function actionGetBuscaUsuario($nomeUsuario)
    {
      /*  $modelSearch = new UsuariosSearch();
        $usuarios = $modelSearch->searchMatriculaUsuario($nomeUsuario);*/


        $usuario = [];
        foreach ($usuarios as $u){
            array_push($usuario , $u);
        }
        echo Json::encode($usuario);
    }

    /**
     * Retorna JSON com os dados do Exemplar de acordo com o Login passado
     * @param $idExemplar
     * Return Json
     */
    public function actionGetExemplar($codigoExemplar)
    {
      /*  $modelSearch = new EmprestimosSearch();
        $exemplar = $modelSearch->searchExemplar($idExemplar);

        echo Json::encode([$exemplar, $exemplar["tipoMaterialIdtipo"]]);*/

        $exemplar = AcervoExemplar::find()
            ->joinWith('acervoIdacervo')
            ->where(['codigo_livro'=>$codigoExemplar])->one();


        echo Json::encode([$exemplar,$exemplar['acervoIdacervo']]);

    }


    public function actionGetDataPrevisaoDevolucao()
    {
        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Sao_Paulo');

        $dataprevisao = date('Y-m-d H:i:s',
            strtotime("+10 days"));
        $dataprevisaoformatado = date('d/m/Y H:i:s',
            strtotime("+10 days"));


        echo Json::encode([$dataprevisao, $dataprevisaoformatado]);
    }

}
