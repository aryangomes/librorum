<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aquisicao */

$this->title = $model->tipoAquisicaoIdtipoAquisicao->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acquisition'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquisicao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idaquisicao], ['class' => 'btn btn-primary',
            'title'=> 'Clique aqui para atualizar a aquisição',]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idaquisicao], [
            'class' => 'btn btn-danger',
            'title'=> 'Clique aqui para excluir a aquisição',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idaquisicao',
            'tipoAquisicaoIdtipoAquisicao.nome',
            'preco',
            'quantidade',
            'pessoaIdpessoa.nome',
        ],
    ]) ?>

</div>
