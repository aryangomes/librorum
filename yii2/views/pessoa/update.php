<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pessoa',
]) . ' ' . $model->idpessoa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pessoas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpessoa, 'url' => ['view', 'id' => $model->idpessoa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pessoa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
