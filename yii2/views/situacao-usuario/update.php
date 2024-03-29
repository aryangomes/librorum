<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SituacaoUsuario */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Situacao Usuario',
]) . $model->situacao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Situacao Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->situacao, 'url' => ['view', 'id' => $model->idsituacao_usuario]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="situacao-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
