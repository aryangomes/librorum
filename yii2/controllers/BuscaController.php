<?php
namespace app\controllers;

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

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionBuscaAcervo($acervo){
        $acervo = Acervo::find()
        ->joinWith('tipoMaterialIdtipoMaterial')
        ->joinWith('categoriaAcervoIdcategoriaAcervo')
        ->where(['LIKE','titulo',$acervo])->one();

        $exemplares = AcervoExemplar::find()
        ->where(['acervo_idacervo'=>$acervo->idacervo])->all();

        return $this->render('index',['acervo'=>$acervo, 'exemplares'=>$exemplares]);
    }
}