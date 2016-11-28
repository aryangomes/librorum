<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */

$this->title = $model->idrelatorio;
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
            'inicio_intervalo',
            'fim_intervalo',
            'data_geracao',
        ],
    ]) ?>

</div>
