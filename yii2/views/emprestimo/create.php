<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Loan')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'usuario' => $usuario,
        'acervo' => $acervo,
        'user' => $user,
        'exemplar' => $exemplar,
        'user' => $user,
        'situacoesusuario' => $situacoesusuario,
        'maxQtdExemplarEmprestimo' => $maxQtdExemplarEmprestimo,
        'mensagem' => $mensagem,
    ])
    ?>

</div>
