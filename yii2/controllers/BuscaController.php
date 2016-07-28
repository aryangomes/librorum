<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Acervo;
use app\models\AcervoExemplar;

class BuscaController extends Controller {

    /**
     * @inheritdoc 
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {

        return $this->render('index', ['session' => $session]);
    }

    public function actionBuscaAcervo($acervo) {
        $session = Yii::$app->session;
        if (strlen($acervo) > 0) {
            $acervo = Acervo::find()
                            ->joinWith('tipoMaterialIdtipoMaterial')
                            ->joinWith('categoriaAcervoIdcategoriaAcervo')
                            ->where(['LIKE', 'titulo', $acervo])->one();

            
            if ($acervo != null) {
                $exemplares = AcervoExemplar::find()
                                ->where(['acervo_idacervo' => $acervo->idacervo])->all();
                if (count($exemplares) > 0) {
                    return $this->render('index', ['acervo' => $acervo, 'exemplares' => $exemplares,
                                'session' => $session]);
                } else {
                    $session->setFlash('buscaAcervo', 'Não foi encontrado nenhum exemplar com esse '
                            . 'título.');
                    return $this->render('index', ['session' => $session]);
                }
            } else {
                $session->setFlash('buscaAcervo', 'Não foi encontrado nenhum exemplar com esse '
                        . 'título.');
                return $this->render('index', ['session' => $session]);
            }
        }else{
            $session->setFlash('buscaAcervo', 'Digite um título.');
             return $this->render('index', ['session' => $session]);
        }
    }

}
