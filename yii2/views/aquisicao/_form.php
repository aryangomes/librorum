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

    <?= $form->field($model, 'quantidade')->textInput(['maxlength' => true, 'placeholder' => 'Ex: 10', 'disabled'=>true,]) ?>

    <?= $form->field($model, 'tipo_aquisicao_idtipo_aquisicao')->dropDownList($tipoAquisicao,
        [
            'value' => isset($model->tipo_aquisicao_idtipo_aquisicao) ?
                $model->tipoAquisicaoIdtipoAquisicao->nome : ''
        ]
    ) ?>

    <?= Html::label('Pessoa Origem') ?>
    <?= Html::input('text',null, $model->pessoaIdpessoa->nome,[
        'disabled'=>true,
        'class'=>'form-control'
    ]) ?>

    <?= $form->field($model, 'pessoa_idpessoa')->hiddenInput([

    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title' => 'Clique aqui para atualizar a aquisição']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>