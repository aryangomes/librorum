<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AcervoExemplar */

$this->title = Yii::t('app', 'Create Acervo Exemplar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervo Exemplars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-exemplar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
