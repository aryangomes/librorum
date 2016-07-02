<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\PessoaFisica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-fisica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cpf')->widget(MaskedInput::className(), [
        'mask' => ['999.999.999-99'],
    ]); ?>

    <?= $form->field($model, 'pessoa_idpessoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>