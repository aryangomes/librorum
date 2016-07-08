<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMaterial */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Type Material')]) . $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->idtipo_material]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
