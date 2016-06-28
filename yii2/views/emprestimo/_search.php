<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmprestimoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emprestimo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idemprestimo') ?>

    <?= $form->field($model, 'usuario_idusuario') ?>

    <?= $form->field($model, 'acervo_idacervo') ?>

    <?= $form->field($model, 'dataemprestimo') ?>

    <?= $form->field($model, 'dataprevisaodevolucao') ?>

    <?php // echo $form->field($model, 'datadevolucao') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
