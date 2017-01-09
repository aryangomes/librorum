<?php

namespace app\controllers;

use app\models\Busca;
use app\models\TipoMaterial;
use Yii;
use yii\helpers\ArrayHelper;
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

        $tiposMateriais = ArrayHelper::map(TipoMaterial::find()->all(),
            'idtipo_material', 'nome' );

        $model->tipoMaterial = 1;

        $model->filtro = 'titulo';

        return $this->render('index',
            [
                'model' => $model,
                'filtros' => $filtros,
                'tiposMateriais'=>$tiposMateriais
            ]);
    }

    public function actionBuscaAcervo()
    {
        $session = Yii::$app->session;

        $busca = Yii::$app->request->get();

        $filtrosEscolhidos = $busca['Busca']['filtro'];

        $tiposMateriais = ArrayHelper::map(TipoMaterial::find()->all(),
           'idtipo_material', 'nome' );

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

            $query->andWhere(['tipo_material_idtipo_material'=>$busca['Busca']['tipoMaterial']]);

            if (count($query->all()) > 0) {

                $countResultado = 0;

                foreach ($query->all() as $acervo) {

                    if ($acervo != null) {

                        $exemplaresAcervo = AcervoExemplar::find()
                            ->where(['acervo_idacervo' => $acervo->idacervo])->all();
                        if (count($exemplaresAcervo) > 0) {

                           array_push($exemplares, $exemplaresAcervo);
                         //  $countResultado += (count($exemplaresAcervo));
                             $countResultado++;
                        }

                        array_push($resultado,[$acervo,$exemplares]);

                    }
                }



                $model = new Busca();

                $model->tipoMaterial = $busca['Busca']['tipoMaterial'];

                $model->filtro = $filtrosEscolhidos;

                $filtros = Busca::$filtros;

                return $this->render('index',
                    [
                        'resultado'=>$resultado,

                        'countResultado'=>$countResultado,

                        'model' => $model,

                        'filtros' => $filtros,

                        'tiposMateriais'=>$tiposMateriais,
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
