<?php

namespace app\controllers;

use Yii;
use app\models\TipoAquisicao;
use app\models\TipoAquisicaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\components\AccessFilter;

/**
 * TipoAquisicaoController implements the CRUD actions for TipoAquisicao model.
 */
class TipoAquisicaoController extends Controller {

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

                    'index' => 'tipo-aquisicao',
                    'update' => 'tipo-aquisicao',
                    'delete' => 'tipo-aquisicao',
                    'create' => 'tipo-aquisicao',
                    'view' => 'tipo-aquisicao',
                    'tipo-aquisicao-list' => 'tipo-aquisicao',
                ],
            ],
        ];
    }

    /**
     * Lists all TipoAquisicao models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TipoAquisicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoAquisicao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TipoAquisicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TipoAquisicao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_aquisicao]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TipoAquisicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_aquisicao]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoAquisicao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoAquisicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoAquisicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TipoAquisicao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTipoAquisicaoList($q = null, $idtipo_aquisicao = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('idtipo_aquisicao AS id, nome AS text')
                    ->from('tipo_aquisicao')
                    ->where(['like', 'nome', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($idtipo_aquisicao > 0) {
            $out['results'] = ['id' => $idtipo_aquisicao, 'text' => TipoMaterial::find($idtipo_aquisicao)->nome];
        }
        return $out;
    }

}
