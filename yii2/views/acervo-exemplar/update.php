<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoExemplar */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Sample')]) . $model->acervoIdacervo->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->acervoIdacervo->titulo, 'url' => ['view', 'id' => $model->acervoIdacervo->titulo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acervo-exemplar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
