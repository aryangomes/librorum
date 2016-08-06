<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAcervo */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Category Collection')]) . $model->categoria;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collection of Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->categoria, 'url' => ['view', 'id' => $model->idcategoria_acervo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categoria-acervo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
