<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = Yii::t('app', 'Update {modelClass}: ',
	['modelClass' => Yii::t('app', 'Loan')]) . ' ' . $model->idemprestimo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idemprestimo, 'url' => ['view', 'id' => $model->idemprestimo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="emprestimo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usuario'=>$usuario,
        'acervo'=>$acervo,
        'user'=>$user,
        'exemplar'=>$exemplar,
        'mensagem' => $mensagem,
    ]) ?>

</div>
