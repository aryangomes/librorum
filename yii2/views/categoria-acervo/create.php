<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAcervo */

$this->title = Yii::t('app', 'Create Categoria Acervo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categoria Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-acervo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
