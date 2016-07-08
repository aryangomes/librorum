<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Collection')]) . ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->idacervo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acervo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
