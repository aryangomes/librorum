<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Acervo',
]) . ' ' . $model->idacervo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idacervo, 'url' => ['view', 'id' => $model->idacervo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acervo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
