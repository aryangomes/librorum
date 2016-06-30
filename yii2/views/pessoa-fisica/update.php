<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PessoaFisica */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pessoa Fisica',
]) . ' ' . $model->pessoa_idpessoa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pessoa Fisicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pessoa_idpessoa, 'url' => ['view', 'id' => $model->pessoa_idpessoa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pessoa-fisica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>