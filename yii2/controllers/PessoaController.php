<?php

namespace app\controllers;

use Yii;
use app\models\Pessoa;
use app\models\PessoaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\AccessFilter;
use app\models\AquisicaoSearch;
/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller {

    public function behaviors() {
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

                    'index' => 'pessoa',
                    'update' => 'pessoa',
                    'delete' => 'pessoa',
                    'create' => 'pessoa',
                      'view' => 'pessoa',
                    'create-ajax' => 'pessoa',
                   
                ],
            ],
        ];
    }

    /**
     * Lists all Pessoa models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PessoaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pessoa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $aquisicaoSearch = new AquisicaoSearch();
       
        $aquisicoes = $aquisicaoSearch->searchAquisicoes($id);

        return $this->render('view', [
                    'model' => $this->findModel($id),
            'aquisicoes' => $aquisicoes,
                 
        ]);
    }


    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idpessoa]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Realiza o cadastro de uma Pessoa via Ajax
     * @param $pessoaNome
     * @param $pessoaTipo
     * @param $identificao
     */
    public function actionCreateAjax($pessoaNome, $pessoaTipo, $identificao) {

        if ($pessoaNome != null) {

            $pessoa = new Pessoa();

            if ($pessoaTipo == 1) {

                $tipoPessoa = new \app\models\PessoaFisica();

                $tipoPessoa->cpf = $identificao;

            } else {
                $tipoPessoa = new \app\models\PessoaJuridica();

                $tipoPessoa->cnpj = $identificao;
            }

            $pessoa->nome = $pessoaNome;
            if ($pessoa->save()) {

                $tipoPessoa->pessoa_idpessoa = $pessoa->idpessoa;

                if ($tipoPessoa->save()) {

                    echo Json::encode($tipoPessoa);
                } else {
                    echo Json::encode(null);
                }
            } else {
                echo Json::encode(null);
            }
        } else {
            echo Json::encode(null);
        }
    }

}
