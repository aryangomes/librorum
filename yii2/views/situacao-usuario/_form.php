<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SituacaoUsuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="situacao-usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'situacao')->textInput(['maxlength' => true]) ?>

<<<<<<< Updated upstream
    <?= $form->field($model, 'pode_emprestar')->textInput() ?>
=======
    <?= $form->field($model, 'pode_emprestar')->dropDownList([1 => 'Pode Emprestar',0 => 'Não Pode Emprestar']) ?>
>>>>>>> Stashed changes

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
