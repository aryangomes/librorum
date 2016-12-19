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

    <?= $form->field($model, 'tipo_aquisicao_idtipo_aquisicao')->textInput(
          [
                'value'=>  isset($model->tipo_aquisicao_idtipo_aquisicao) ?
                $model->tipoAquisicaoIdtipoAquisicao->nome : ''
            ]
            ) ?>

    <?= $form->field($model, 'pessoa_idpessoa')->textInput( [
                'value'=>  isset($model->pessoaIdpessoa) ?
                $model->pessoaIdpessoa->nome : ''
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
           'title'=> 'Clique aqui para atualizar a aquisição']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>