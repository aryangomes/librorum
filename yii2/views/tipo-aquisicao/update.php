<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAquisicao */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Type Acquisition')]) . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Aquisicaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->idtipo_aquisicao]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-aquisicao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
