<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'User')]) . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'idusuario' => $model->idusuario, 'nome' => $model->nome, 'rg' => $model->rg]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
