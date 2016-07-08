<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Acervo;

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
        $query = Acervo::find()->joinWith('tipoMaterialIdtipoMaterial')
        /*->joinWith('acervoAutores')*/
        ->where(['LIKE','titulo',$acervo])->all();

        return $this->render('index',['query'=>$query]);
    }    
}