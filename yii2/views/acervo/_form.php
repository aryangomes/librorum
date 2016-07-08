<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

use yii\web\JsExpression;
use app\models\TipoMaterial;
use app\models\CategoriaAcervo;

$urltipomaterial = \yii\helpers\Url::to(['tipo-material/tipo-material-list']);
$urltipoaquisicao = \yii\helpers\Url::to(['tipo-aquisicao/tipo-aquisicao-list']);
$urlcategoriaacervo = \yii\helpers\Url::to(['categoria-acervo/categoria-acervo-list']);

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
                    'categoria_acervo_idcategoria_acervo'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => 'kartik\widgets\Select2','options' => ['pluginOptions' =>[
                        
                        'placeholder'=>'Digite a categoria do material. Ex: Romance, Jornalismo ...',
                        'allowClear' => true,
                        'minimumInputLength' => 2,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => $urlcategoriaacervo,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(tipo) { return tipo.text; }'),
                        'templateSelection' => new JsExpression('function (tipo) { return tipo.text; }'),
                    ]]],
                    'tipo_material_idtipo_material'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => 'kartik\widgets\Select2','options' => ['pluginOptions' =>[
                    
                        'placeholder'=>'Digite o Tipo de Material. Ex: Livro, Revista ...',
                        'allowClear' => true,
                        'minimumInputLength' => 2,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => $urltipomaterial,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(tipo) { return tipo.text; }'),
                        'templateSelection' => new JsExpression('function (tipo) { return tipo.text; }'),
                    ]]],
                ]
            ],
            [
                'attributes'=>[       // 1 column layout
                    'titulo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Ex: Dom Casmurro']],
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
                    'aquisicao_idaquisicao'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => 'kartik\widgets\Select2','options' => ['pluginOptions' =>[
                    
                        'placeholder'=>'Digite o Tipo de Aquisição. Ex: Doação, Compra ...',
                        'allowClear' => true,
                        'minimumInputLength' => 2,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => $urltipoaquisicao,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(tipo) { return tipo.text; }'),
                        'templateSelection' => new JsExpression('function (tipo) { return tipo.text; }'),
                    ]]],
                ],
            ],
        ]
    ]);
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Catalog') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>