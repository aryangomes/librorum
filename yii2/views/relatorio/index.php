<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Relatorios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model'=> Yii::t('app', 'Relatório')]), ['create'], ['class' => 'btn btn-success',
            'title'=>'Clique aqui para cadastrar um relatório',
            'data-toggle'=>"tooltip"]) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute'=>'tipo',
                'filter'=>$tiposRelatorio,
                'value'=> function ($model) {
                    return isset($model->tipo) ?
                        \app\models\Relatorio::$tiposRelatorio[$model->tipo] : null;
                }
            ],

            [
                'attribute'=>'inicio_intervalo',
                'value'=> function ($model){
                    return isset($model->inicio_intervalo) ?
                        Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') : null;
                },
            ],

            [
                'attribute'=>'fim_intervalo',
                'value'=> function ($model){
                    return isset($model->fim_intervalo) ?
                        Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y') : null;
                },
            ],

            [
                'attribute'=>'data_geracao',
                'value'=> function ($model){
                    return isset($model->data_geracao) ?
                        Yii::$app->formatter->asDate($model->data_geracao, 'dd/M/Y') : null;
                },

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
