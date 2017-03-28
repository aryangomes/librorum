<?php

namespace app\controllers;

use app\models\TipoAquisicao;
use Yii;
use app\models\Aquisicao;
use app\models\AquisicaoSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessFilter;
/**
 * AquisicaoController implements the CRUD actions for Aquisicao model.
 */
class AquisicaoController extends Controller
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

                    'index' => 'aquisicao',
                    'update' => 'aquisicao',
                    'delete' => 'aquisicao',
                    'create' => 'aquisicao',
                    'view' => 'aquisicao',
                ],
            ],
        ];
    }

    /**
     * Lists all Aquisicao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AquisicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aquisicao model.
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
     * Updates an existing Aquisicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tipoAquisicao = ArrayHelper::map(TipoAquisicao::find()->all(), 'idtipo_aquisicao','nome');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idaquisicao]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipoAquisicao'=>$tipoAquisicao
            ]);
        }
    }

    /**
     * Deletes an existing Aquisicao model.
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
     * Finds the Aquisicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aquisicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aquisicao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
