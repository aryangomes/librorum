<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */
/* @var $tiposRelatorio array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->dropDownList($tiposRelatorio, ['prompt'=>'Selecione o tipo de Relatório...',
    'disabled'=>$model->isNewRecord ? false:true]) ?>

    <?= $form->field($model, 'inicio_intervalo')->input('date',['class'=>'form-control']) ?>

    <?= $form->field($model, 'fim_intervalo')->input('date',['class'=>'form-control']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title'=>$model->isNewRecord ? 'Clique aqui para cadastrar um relatório':'Clique aqui para atualizar um relatório',
            'data-toggle'=>"tooltip"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
