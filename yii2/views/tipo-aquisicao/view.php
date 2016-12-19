<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAquisicao */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types of Acquisitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aquisicao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idtipo_aquisicao], ['class' => 'btn btn-primary',
            'title'=> 'Clique aqui para atualizar o tipo de aquisição',]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idtipo_aquisicao], [
            'class' => 'btn btn-danger',
            'title'=> 'Clique aqui para excluir o tipo de aquisição',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idtipo_aquisicao',
            'nome',
        ],
    ]) ?>

</div>
