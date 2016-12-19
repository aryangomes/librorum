<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAcervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-acervo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title'=>$model->isNewRecord ? 'Clique aqui para cadastrar uma categoria do acervo':'Clique aqui para atualizar uma categoria do acervo',
            'data-toggle'=>"tooltip"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
