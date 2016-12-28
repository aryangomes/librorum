<?php

namespace app\controllers;

use app\components\AccessFilter;
use Yii;
use app\models\Relatorio;
use app\models\RelatorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * RelatorioController implements the CRUD actions for Relatorio model.
 */
class RelatorioController extends Controller
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

                    'index' => 'relatorio',
                    'update' => 'relatorio',
                    'delete' => 'relatorio',
                    'create' => 'relatorio',
                    'view' => 'relatorio',
                    'gerar-relatorio-emprestimos' => 'relatorio',
                    'gerar-relatorio-devolucoes' => 'relatorio',

                ],
            ],
        ];
    }

    /**
     * Lists all Relatorio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelatorioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tiposRelatorio' => Relatorio::$tiposRelatorio,
        ]);
    }

    /**
     * Displays a single Relatorio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelRelatorio = $this->findModel($id);

        $searchModel = new RelatorioSearch();

        $dadosGrafico = null;
        
        switch ($modelRelatorio->tipo){
            case 'emprestimos':
                $dadosGrafico = $searchModel->searchRelatorioEmprestimos(
                    $modelRelatorio->inicio_intervalo,
                    $modelRelatorio->fim_intervalo
                );
                break;
            case 'devolucoes':
                $dadosGrafico = $searchModel->searchRelatorioDevolucoes(
                    $modelRelatorio->inicio_intervalo,
                    $modelRelatorio->fim_intervalo
                );
                break;
            
            default:
                break;
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'dadosGrafico'=>$dadosGrafico,
        ]);
    }

    /**
     * Creates a new Relatorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelRelatorio = new Relatorio();


        $modelRelatorio->data_geracao = date('Y-m-d');

        $modelRelatorio->inicio_intervalo = date('Y-m-d');

        $modelRelatorio->fim_intervalo = date('Y-m-d');

        if ($modelRelatorio->load(Yii::$app->request->post()) && $modelRelatorio->save()) {
            return $this->redirect(['view', 'id' => $modelRelatorio->idrelatorio]);
        } else {
            return $this->render('create', [
                'model' => $modelRelatorio,
                'tiposRelatorio' => Relatorio::$tiposRelatorio,
            ]);
        }
    }

    /**
     * Updates an existing Relatorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrelatorio]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tiposRelatorio' => Relatorio::$tiposRelatorio,
            ]);
        }
    }

    /**
     * Deletes an existing Relatorio model.
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
     * Finds the Relatorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relatorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relatorio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGerarRelatorioEmprestimos($id)
    {

        //Setando a data para o fuso do Brasil
        date_default_timezone_set('America/Sao_Paulo');

        $modelRelatorio = $this->findModel($id);

        if ($modelRelatorio != null) {

            $searchModel = new RelatorioSearch();

            $dados = $searchModel->searchRelatorioEmprestimos(
                $modelRelatorio->inicio_intervalo,
                $modelRelatorio->fim_intervalo
            );

            $title = 'Relatório de Empréstimo (de ' . date("d/m/Y", strtotime
                ($modelRelatorio->inicio_intervalo)) . ' até ' . date("d/m/Y", strtotime
                ($modelRelatorio->fim_intervalo)) . ')';


            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                'content' => $this->renderPartial('pdf' . $modelRelatorio->tipo, [
                    'dados' => $dados,
                    'title' => $title

                ]),
                'filename' => 'relatorio-emprestimo-de-' .
                    date("d-m-Y", strtotime
                    ($modelRelatorio->inicio_intervalo))
                    . '-ate-' .
                    date("d-m-Y", strtotime
                    ($modelRelatorio->fim_intervalo))
                    . '.pdf',
                'options' => [
                    'title' => $title,
                ],
                'methods' => [
                    'SetHeader' => ['Gerado por: Krajee Pdf Component||Gerado em: ' .
                        date("d/m/Y H:i:s")],
                    'SetFooter' => ['|Página{PAGENO}|'],
                ]
            ]);
            return $pdf->render();
        }

        return $this->redirect('index');

    }

    public function actionGerarRelatorioDevolucoes($id)
    {

        //Setando a data para o fuso do Brasil
        date_default_timezone_set('America/Sao_Paulo');

        $modelRelatorio = $this->findModel($id);

        if ($modelRelatorio != null) {

            $searchModel = new RelatorioSearch();

            $dados = $searchModel->searchRelatorioDevolucoes(
                $modelRelatorio->inicio_intervalo,
                $modelRelatorio->fim_intervalo
            );

            $title = 'Relatório de Devoluções (de ' . date("d/m/Y", strtotime
                ($modelRelatorio->inicio_intervalo)) . ' até ' . date("d/m/Y", strtotime
                ($modelRelatorio->fim_intervalo)) . ')';


            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                'content' => $this->renderPartial('pdf' . $modelRelatorio->tipo, [
                    'dados' => $dados,
                    'title' => $title

                ]),
                'filename' => 'relatorio-devolucoes-de-' .
                    date("d-m-Y", strtotime
                    ($modelRelatorio->inicio_intervalo))
                    . '-ate-' .
                    date("d-m-Y", strtotime
                    ($modelRelatorio->fim_intervalo))
                    . '.pdf',
                'options' => [
                    'title' => $title,
                ],
                'methods' => [
                    'SetHeader' => ['Gerado por: Krajee Pdf Component||Gerado em: ' .
                        date("d/m/Y H:i:s")],
                    'SetFooter' => ['|Página{PAGENO}|'],
                ]
            ]);
            return $pdf->render();
        }

        return $this->redirect('index');

    }
}
