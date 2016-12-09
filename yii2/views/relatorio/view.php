<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */

$this->title = 'Relatório de ' . $model->tipo . ' de ' .
    Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') . ' até '.
    Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relatorios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idrelatorio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idrelatorio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <!-- Gerar Relatório Empréstimo-->
        <?php
        echo isset($model->datadevolucao) ? '' :
            Html::a('Gerar Comprovante de Empréstimo', ['gerar-relatorio-'.$model->tipo,
                'id' => $model->idrelatorio], [
                'class' => 'btn btn-success',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Clique aqui para gerar o comprovante do empréstimo',
            ]);
        ?>
        <!-- Gerar Relatório Empréstimo-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrelatorio',
            'tipo',

            [
                'attribute'=>'inicio_intervalo',
                'value'=> isset($model->inicio_intervalo) ?
                    Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') : null,

            ],

            [
                'attribute'=>'fim_intervalo',
                'value'=> isset($model->fim_intervalo) ?
                    Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y') : null,

            ],

            [
                'attribute'=>'data_geracao',
                'value'=> isset($model->data_geracao) ?
                    Yii::$app->formatter->asDate($model->data_geracao, 'dd/M/Y') : null,

            ],
        ],
    ]) ?>

</div>
