<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = $model->idemprestimo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emprestimos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idemprestimo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idemprestimo], [
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
            'idemprestimo',
            'usuario_idusuario',
            'acervo_idacervo',
            'dataemprestimo',
            'dataprevisaodevolucao',
            'datadevolucao',
        ],
    ]) ?>

</div>
