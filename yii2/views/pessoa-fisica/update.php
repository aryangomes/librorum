<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PessoaFisica */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Physical Person')]) . ' ' . $model->cpf;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Physical People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cpf, 'url' => ['view', 'id' => $model->pessoa_idpessoa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pessoa-fisica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
