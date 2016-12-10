<?php

namespace app\controllers;

use app\models\Busca;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Acervo;
use app\models\AcervoExemplar;

class BuscaController extends Controller
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
        ];
    }

    public function actionIndex()
    {

        $model = new Busca();

        $filtros = Busca::$filtros;

        return $this->render('index',
            [
                'model' => $model,
                'filtros' => $filtros,
            ]);
    }

    public function actionBuscaAcervo()
    {
        $session = Yii::$app->session;

        $busca = Yii::$app->request->get();

        $filtrosEscolhidos = $busca['Busca']['filtro'];

        $exemplares = [];

        if (strlen($busca['acervo']) > 0) {

            $query = Acervo::find()
                ->joinWith('tipoMaterialIdtipoMaterial')
                ->joinWith('categoriaAcervoIdcategoriaAcervo');

            if(($filtrosEscolhidos) != ''){
                foreach ($filtrosEscolhidos as $filtro) {
                    $query->orWhere(['LIKE', $filtro, $busca['acervo']]);
                }
            }


            $resultado = [];


            if (count($query->all()) > 0) {

                foreach ($query->all() as $acervo) {

                    if ($acervo != null) {

                        $exemplaresAcervo = AcervoExemplar::find()
                            ->where(['acervo_idacervo' => $acervo->idacervo])->all();
                        if (count($exemplaresAcervo) > 0) {

                           array_push($exemplares, $exemplaresAcervo);

                        }

                        array_push($resultado,[$acervo,$exemplares]);
                    }
                }

                $model = new Busca();

                $filtros = Busca::$filtros;

                return $this->render('index',
                    [
                        'resultado'=>$resultado,

                        'model' => $model,

                        'filtros' => $filtros,
                    ]);
            } else {
                $session->setFlash('buscaAcervo', 'Nada encontrado');
                return $this->redirect('index');
            }


        } else {
            $session->setFlash('buscaAcervo', 'Digite uma consulta.');
            return $this->redirect('index');
        }
    }

}
