<?php

use yii\helpers\Html;
use \yii\widgets\MaskedInput;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome', [
        'feedbackIcon' => [
            //'prefix' => 'fa fa-',
            'default' => 'user',
            'success' => 'user-plus',
            'error' => 'user-times',
            'defaultOptions' => ['class'=>'text-warning']
        ]
    ])->textInput(['placeholder'=>'Enter username...']);

    ?>
    <?= $form->field($model, 'rg')->widget(MaskedInput::className(), [
        'mask' => ['99.999.999-9'],
    ]);?>

    <?=  $form->field($model, 'cpf')->widget(MaskedInput::className(), [
        'mask' => ['999.999.999-99'],
    ]); ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reparticao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone', [
        'feedbackIcon' => [
            //'prefix' => 'fa fa-',
            'default' => 'phone',
            'success' => 'check-circle',
            'error' => 'exclamation-circle',
        ]
    ])->widget(MaskedInput::className(), [
        'mask' => '(99)99999-9999'
    ]);?>

    <?= $form->field($model, 'email', [
        'feedbackIcon' => [
            'default' => 'envelope',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]
    ])->textInput(['placeholder'=>yii::t('app','Enter a valid email address...')]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>