<?php

namespace app\controllers;

use Yii;
use app\models\TipoMaterial;
use app\models\TipoMaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessFilter;
use yii\db\Query;

/**
 * TipoMaterialController implements the CRUD actions for TipoMaterial model.
 */
class TipoMaterialController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'autorizacao' => [
                'class' => AccessFilter::className(),
                'actions' => [

                    'index' => 'tipo-material',
                    'update' => 'tipo-material',
                    'delete' => 'tipo-material',
                    'create' => 'tipo-material',
                    'view' => 'tipo-material',
                    'tipo-material-list' => 'tipo-material',
                ],
            ],
        ];
    }

    /**
     * Lists all TipoMaterial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoMaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoMaterial model.
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
     * Creates a new TipoMaterial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoMaterial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_material]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TipoMaterial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipo_material]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoMaterial model.
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
     * Finds the TipoMaterial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoMaterial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoMaterial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Retorna os Tipos de Material
     * @param null $q
     * @param null $idtipo_material
     * @return array
     */
    public function actionTipoMaterialList($q = null, $idtipo_material = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($q)) {
            $query = new Query;

            $query->select('idtipo_material AS id, nome AS text')
                ->from('tipo_material')
                ->where(['like', 'nome', $q])
                ->limit(20);

            $command = $query->createCommand();

            $data = $command->queryAll();

            $out['results'] = array_values($data);
        }
        elseif ($idtipo_material > 0) {
            $out['results'] = ['id' => $idtipo_material, 'text' => TipoMaterial::find($idtipo_material)->nome];
        }
        return $out;
    }
}
