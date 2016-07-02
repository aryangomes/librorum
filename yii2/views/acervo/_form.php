<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">

    <?php
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    
    echo FormGrid::widget([
        'model'=>$model,
        'form'=>$form,
        'autoGenerateColumns'=>true,
        'rows'=>[
            [
                'contentBefore'=>'<legend class="text-info"><small>Material</small></legend>',
                'attributes'=>[       // 2 column layout
                    'tipo_material_idtipo_material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
                    'titulo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: Dom Casmurro']],
                ]
            ],
            [
                'attributes'=>[       // 1 column layout
                    'autor'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: Machado de Assis']],
                    'editora'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: Abril']],
                ],
            ],
            [
                'attributes'=>[       // 1 column layout
                    'cdd'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: 48.194']],
                    'chamada'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: 48.194.25']],
                ],
            ],
            [
                'contentBefore'=>'<legend class="text-info"><small>Aquisição</small></legend>',
                'attributes'=>[
                    'aquisicao_idaquisicao'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: Doação']],
                ],
            ],
        ]
    ]);
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>