<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAcervo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Categoria Acervo',
]) . $model->idcategorial_acervo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categoria Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcategorial_acervo, 'url' => ['view', 'id' => $model->idcategorial_acervo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categoria-acervo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
