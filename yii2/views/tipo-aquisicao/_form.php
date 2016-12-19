<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAquisicao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-aquisicao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true,
    'placeholder'=>'Digite o nome do Tipo de Aquisição']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title'=>$model->isNewRecord ? 'Clique aqui para cadastrar um tipo de aquisição':'Clique aqui para atualizar uum tipo de aquisição',
            'data-toggle'=>"tooltip"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
