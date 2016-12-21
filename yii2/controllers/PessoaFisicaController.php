<?php

namespace app\controllers;

use Yii;
use app\models\PessoaFisica;
use app\models\PessoaFisicaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessFilter;

/**
 * PessoaFisicaController implements the CRUD actions for PessoaFisica model.
 */
class PessoaFisicaController extends Controller {

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

                    'index' => 'pessoa-fisica',
                    'update' => 'pessoa-fisica',
                    'delete' => 'pessoa-fisica',
                    'create' => 'pessoa-fisica',
                    'view' => 'pessoa-fisica',
                ],
            ],
        ];
    }

    /**
     * Lists all PessoaFisica models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PessoaFisicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PessoaFisica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }



    /**
     * Updates an existing PessoaFisica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pessoa_idpessoa]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PessoaFisica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PessoaFisica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PessoaFisica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PessoaFisica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
