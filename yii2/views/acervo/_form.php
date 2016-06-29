<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cdd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'autor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chamada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aquisicao_idaquisicao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
