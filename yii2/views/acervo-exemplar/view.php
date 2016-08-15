<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoExemplar */

$this->title = $model->acervoIdacervo->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-exemplar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idacervo_exemplar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idacervo_exemplar], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idacervo_exemplar',
            'acervoIdacervo.titulo',
            'codigo_livro',
            //'esta_disponivel',
            [
                'attribute' => 'esta_disponivel',
                'value' => $model->esta_disponivel ? 'Disponível' : 'Não disponível'
            ],
        ],
    ]) ?>

</div>
