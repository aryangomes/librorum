<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoExemplar */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Acervo Exemplar',
]) . ' ' . $model->idacervo_exemplar;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervo Exemplars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idacervo_exemplar, 'url' => ['view', 'id' => $model->idacervo_exemplar]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acervo-exemplar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
