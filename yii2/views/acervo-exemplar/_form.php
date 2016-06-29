<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoExemplar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-exemplar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acervo_idacervo')->textInput() ?>

    <?= $form->field($model, 'codigo_livro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
