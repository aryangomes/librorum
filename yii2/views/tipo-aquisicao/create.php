<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAquisicao */

$this->title = Yii::t('app', 'Create Tipo Aquisicao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Aquisicaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aquisicao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
