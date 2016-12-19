<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $configuracoes array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'chave')->dropDownList(
            $configuracoes,['prompt' => 'Selecione a Configuração...',
    'disabled'=>$model->isNewRecord ? false: true]) ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title'=>'Clique aqui para atualizar a configuração',
            'data-toggle'=>"tooltip"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
