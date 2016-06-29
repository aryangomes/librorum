<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idacervo') ?>

    <?= $form->field($model, 'cdd') ?>

    <?= $form->field($model, 'autor') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'editora') ?>

    <?php // echo $form->field($model, 'tipo_material') ?>

    <?php // echo $form->field($model, 'chamada') ?>

    <?php // echo $form->field($model, 'aquisicao_idaquisicao') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
