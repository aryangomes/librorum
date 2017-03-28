<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $usuarioModel \app\models\Usuario */

$this->title = 'Histórico de empréstimos de ' . $usuarioModel->nome;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Empréstimo',
                    'format' => 'raw',
                    'visible'=>Yii::$app->user->can('admin'),
                    'value' => function ($model) {
                        return Html::a('Visualizar Empréstimo', ['/emprestimo/view', 'id' => $model->idemprestimo]);
                    }
                ],

                [
                    'attribute'=>'dataemprestimo',
                    'value'=> function ($model){
                        return isset($model->dataemprestimo) ?
                            Yii::$app->formatter->asDate($model->dataemprestimo, 'dd/M/Y à\s HH:m') : null;
                    },

                ],

                [
                    'attribute'=>'dataprevisaodevolucao',
                    'value'=> function ($model){
                        return isset($model->dataprevisaodevolucao) ?
                            Yii::$app->formatter->asDate($model->dataprevisaodevolucao, 'dd/M/Y') : null;
                    },
                ],

                [
                    'attribute'=>'datadevolucao',
                    'value'=> function ($model){
                        return isset($model->datadevolucao) ?
                            Yii::$app->formatter->asDate($model->datadevolucao, 'dd/M/Y à\s HH:m') : 'Não devolvido';
                    },
                ],

                [
                    'label'=>'Exemplar(es) Emprestado(s)',
                    'attribute'=>'AcervoExemplarIdacervoExemplars',
                    'value'=> function ($model){
                        $exemplares = "";
                        foreach ($model->acervoExemplarIdacervoExemplars as $key => $exemplar){
                            $exemplares .= $exemplar['acervoIdacervo']->titulo;

                            if($key < (count($model->acervoExemplarIdacervoExemplars)-1) &&
                                count($model->acervoExemplarIdacervoExemplars) >1 ){
                               $exemplares .= ', ' ;
                            }
                        }
                        return  $exemplares;
                    },
                ],



            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
