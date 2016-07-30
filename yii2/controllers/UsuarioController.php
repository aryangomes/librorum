<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessFilter;
/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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

                    'index' => 'usuario',
                    'update' => 'usuario',
                    'delete' => 'usuario',
                    'create' => 'usuario',
                    'view' => 'usuario',
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $idusuario
     * @param string $nome
     * @param string $rg
     * @return mixed
     */
    public function actionView($idusuario, $nome, $rg)
        {

        return $this->render('view', [
            'model' => $this->findModel($idusuario, $nome, $rg),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idusuario' => $model->idusuario, 'nome' => $model->nome, 'rg' => $model->rg]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idusuario
     * @param string $nome
     * @param string $rg
     * @return mixed
     */
    public function actionUpdate($idusuario, $nome, $rg)
    {
        $model = $this->findModel($idusuario, $nome, $rg);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idusuario' => $model->idusuario, 'nome' => $model->nome, 'rg' => $model->rg]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idusuario
     * @param string $nome
     * @param string $rg
     * @return mixed
     */
    public function actionDelete($idusuario, $nome, $rg)
    {
        $model =  $this->findModel($idusuario, $nome, $rg);

        if($model->delete()){
        $this->findModel($idusuario, $nome, $rg)->deleteFoto();

            return $this->redirect(['index']);
        }


    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idusuario
     * @param string $nome
     * @param string $rg
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idusuario, $nome, $rg)
    {
        if (($model = Usuario::findOne(['idusuario' => $idusuario, 'nome' => $nome, 'rg' => $rg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
