<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'placeholder' => 'Ex: José Vitor']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title'=>$model->isNewRecord ? 'Clique aqui para cadastrar uma pessoa da aquisição':'Clique aqui para atualizar uma pessoa da aquisição',
            'data-toggle'=>"tooltip"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>