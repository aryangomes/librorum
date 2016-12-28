<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */


$this->title = 'Relatório de ' . $model->tipo . ' de ' .
    Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') . ' até ' .
    Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relatórios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idrelatorio], ['class' => 'btn btn-primary',
            'title' => 'Clique aqui para atualizar o relatório',]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idrelatorio], [
            'class' => 'btn btn-danger',
            'title' => 'Clique aqui para excluir o relatório',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <!-- Gerar Relatório Empréstimo-->
        <?php
        echo isset($model->datadevolucao) ? '' :
            Html::a('Gerar PDF do Relatório', ['gerar-relatorio-' . $model->tipo,
                'id' => $model->idrelatorio], [
                'class' => 'btn btn-success',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Clique aqui para gerar um PDF do relatório',
            ]);
        ?>
        <!-- Gerar Relatório Empréstimo-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrelatorio',
           [
               'attribute'=>'tipo',
               'value'=>\app\models\Relatorio::$tiposRelatorio[$model->tipo],
           ],

            [
                'attribute' => 'inicio_intervalo',
                'value' => isset($model->inicio_intervalo) ?
                    Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') : null,

            ],

            [
                'attribute' => 'fim_intervalo',
                'value' => isset($model->fim_intervalo) ?
                    Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y') : null,

            ],

            [
                'attribute' => 'data_geracao',
                'value' => isset($model->data_geracao) ?
                    Yii::$app->formatter->asDate($model->data_geracao, 'dd/M/Y') : null,

            ],
        ],
    ]) ?>

    <?php
    if(isset($dadosGrafico) && (count($dadosGrafico[0]) > 0)){

    ?>
    <?php HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']); ?>
    <?=

    Highcharts::widget([
        'options' => [
            'chart' => [
                'type' => 'column'],
            'title' =>  ['text' => \app\models\Relatorio::$tiposRelatorio[$model->tipo] . ' de ' .
                Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') . ' até '.
                Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y')],
            'xAxis' => [
                'categories' => $dadosGrafico[0]
            ],
            'yAxis' => [
                'title' => ['text' => \app\models\Relatorio::$tiposRelatorio[$model->tipo]]
            ],
            'credits' => false,
            'series' => [
                [
                    'name' => \app\models\Relatorio::$tiposRelatorio[$model->tipo],
                    'data' => $dadosGrafico[1]],

            ]
        ]
    ]);


    ?>
    <?php
    }
    ?>
</div>
