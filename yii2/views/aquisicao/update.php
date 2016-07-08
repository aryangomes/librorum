<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aquisicao */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Acquisition')]) . ' ' . $model->idaquisicao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acquisitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idaquisicao, 'url' => ['view', 'id' => $model->idaquisicao]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aquisicao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
