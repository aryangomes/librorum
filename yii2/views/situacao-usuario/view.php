<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SituacaoUsuario */

$this->title = 'Situação: '.$model->situacao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Situacao Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situacao-usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idsituacao_usuario], ['class' => 'btn btn-primary',
            'title'=> 'Clique aqui para atualizar a situação do usuário',]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idsituacao_usuario], [
            'class' => 'btn btn-danger',
            'title'=> 'Clique aqui para excluir a situação do usuário',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idsituacao_usuario',
            'situacao',
            [
                'attribute' => 'pode_emprestar',
                'value' => $model->pode_emprestar ? 'Pode' : 'Não Pode'
            ],
        ],
    ]) ?>

</div>
