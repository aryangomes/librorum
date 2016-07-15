<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SituacaoUsuario */

$this->title = Yii::t('app', 'Create Situacao Usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Situacao Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situacao-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
