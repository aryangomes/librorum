<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = Yii::t('app', 'Create Emprestimo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emprestimos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usuario'=>$usuario,
        'acervo'=>$acervo,
        'exemplar'=>$exemplar
    ]) ?>

</div>
