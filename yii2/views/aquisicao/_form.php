<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aquisicao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aquisicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade')->textInput(['maxlength' => true, 'placeholder' => 'Ex: 10']) ?>

    <?= $form->field($model, 'tipo_aquisicao_idtipo_aquisicao')->textInput() ?>

    <?= $form->field($model, 'pessoa_idpessoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>