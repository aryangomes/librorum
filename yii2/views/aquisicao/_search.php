<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AquisicaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aquisicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idaquisicao') ?>

    <?= $form->field($model, 'preco') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'tipo_aquisicao_idtipo_aquisicao') ?>

    <?= $form->field($model, 'pessoa_idpessoa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
