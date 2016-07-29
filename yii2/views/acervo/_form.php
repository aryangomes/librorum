<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;
use yii\web\JsExpression;
use app\models\TipoMaterial;
use app\models\CategoriaAcervo;
use app\models\Pessoa;

$urltipomaterial = \yii\helpers\Url::to(['tipo-material/tipo-material-list']);
$urltipoaquisicao = \yii\helpers\Url::to(['tipo-aquisicao/tipo-aquisicao-list']);
$urlcategoriaacervo = \yii\helpers\Url::to(['categoria-acervo/categoria-acervo-list']);

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);

    //Formulário para a Pessoa
    echo FormGrid::widget([
        'model' => $pessoa,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Pessoa</small></legend>',
                'attributes' => [
                    'nome' => ['type' => Form::INPUT_TEXT,
                        'options' => ['id' => 'busca-pessoa',]],
                ]
            ],
        ]
    ]);
    ?>
    <!-- --------------------  BEGIN Cadastrar Pessoa  --------------------- -->
    <?php
    Modal::begin([
        'header' => '<h2>Cadastrar Pessoa</h2>',
        'id' => 'modalcadastrarpessoa'
    ]);
    ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Nome', 'pessoa-nome') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?=
                Html::input('text', 'pessoa-nome', null, ['class' => 'form-control',
                    'id' => 'pessoa-nome',
                    'placeholder' => 'Digite o nome da pessoa'])
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Tipo de Pessoa', 'pessoa-tipo') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?=
                Html::dropDownList('pessoa-tipo', '', [1 => 'Pessoa Física', 2 => 'Pessoa Jurídica'], ['class' => 'form-control', 'id' => 'pessoa-tipo',
                    'prompt' => 'Selecione o tipo de pessoa'])
                ?>
            </div>
        </div>

        <div id="pessoa-cpf-post">
            <div class="row">
                <div class="col-md-4">
                    <?= Html::label('Cpf', 'pessoa-cpf') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?=
                    MaskedInput::widget([
                        'name' => 'pessoa-cpf',
                        'mask' => '999.999.999-99',
                        'options' => ['class' => 'form-control',
                            'id' => 'pessoa-cpf'],
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div id="pessoa-cnpj-post">
            <div class="row">
                <div class="col-md-4">
                    <?= Html::label('Cnpj', 'pessoa-cnpj') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?=
                    MaskedInput::widget([
                        'name' => 'pessoa-cnpj',
                        'mask' => '99.999.999/9999-99',
                        'options' => ['class' => 'form-control',
                            'id' => 'pessoa-cnpj'],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <?= Html::button('Cadastrar', ['id' => 'btCadastrarPessoa', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php
    Modal::end();
    ?>
    <!-- --------------------  END Cadastrar Pessoa  --------------------- -->
    <div id="mensagem-busca-pessoa">

    </div>

    <?php
    //Formulário para a Aquisição do Material
    echo FormGrid::widget([
        'model' => $aquisicao,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Aquisição</small></legend>',
                'attributes' => [       // 2 column layout
                    'tipo_aquisicao_idtipo_aquisicao' => ['type' => Form::INPUT_WIDGET,
                        'widgetClass' => 'kartik\widgets\Select2',
                        'options' => [
                            'initValueText' => isset($aquisicao->tipo_aquisicao_idtipo_aquisicao) ? app\models\TipoAquisicao::findOne
                                            ($aquisicao->tipo_aquisicao_idtipo_aquisicao)->nome : '',
                            'pluginOptions' => [
                                'placeholder' => Yii::t('app', 'Digite o tipo de aquisiçãoo. Ex: Compra, Doação ...'),
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return '" . Yii::t('app', 'Waiting for results...') . "'; }"),
                                ],
                                'ajax' => [
                                    'url' => $urltipoaquisicao,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(situacao) { return situacao.text; }'),
                                'templateSelection' => new JsExpression('function (situacao) { return situacao.text; }'),
                            ],
                        ],
                    ],
                    'pessoa_idpessoa' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => $tiposPessoa, 'options' => [

                            'prompt' => 'Selecione',
                          'disabled' => $model->isNewRecord ? false : true
                        ]
                    ],
                    'preco' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: Valor']],
                ]
            ],
        ]
    ]);



    echo FormGrid::widget([
        'model' => $aquisicao,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Aquisição</small></legend>',
                'attributes' => [
                    'pessoa_idpessoa' => ['type' => Form::INPUT_HIDDEN, 'options' => [

                            'id' => 'pessoa-idpessoa']],
                ]
            ]
        ]
    ]);

    //Formulário para a Pessoa Física
    echo FormGrid::widget([
        'model' => $pessoaFisica,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Pessoa Física</small></legend>',
                'attributes' => [
                    'cpf' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\yii\widgets\MaskedInput',
                        'options' => ['mask' => ['999.999.999-99'],]],
                ]
            ],
        ]
    ]);

    //Formulário para a Pessoa Jurídica
    echo FormGrid::widget([
        'model' => $pessoaJuridica,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Pessoa Jurídica</small></legend>',
                'attributes' => [
                    'cnpj' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\yii\widgets\MaskedInput', 'options' => ['mask' => ['99.999.999/9999-99'],]],
                ]
            ],
        ]
    ]);

    //Formulário de Acervo
    echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Material</small></legend>',
                'attributes' => [       // 2 column layout
                    'categoria_acervo_idcategoria_acervo' => ['type' => Form::INPUT_WIDGET,
                        'widgetClass' => 'kartik\widgets\Select2',
                        'options' => [
                            'initValueText' => isset($model->categoria_acervo_idcategoria_acervo) ? app\models\CategoriaAcervo::findOne
                                            ($model->categoria_acervo_idcategoria_acervo)->categoria : '',
                            'pluginOptions' => [

                                'placeholder' => 'Digite a categoria do material. Ex: Romance, Jornalismo ...',
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
                    'tipo_material_idtipo_material' => ['type' => Form::INPUT_WIDGET,
                        'widgetClass' => 'kartik\widgets\Select2',
                        'options' => [
                            'initValueText' =>
                            isset($model->tipo_material_idtipo_material) ?
                                    TipoMaterial::findOne($model->tipo_material_idtipo_material)->nome : '',
                            'pluginOptions' => [

                                'placeholder' => 'Digite o Tipo de Material. Ex: Livro, Revista ...',
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
                'attributes' => [       // 1 column layout
                    'titulo' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: Dom Casmurro']],
                    'autor' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: Machado de Assis']],
                    'editora' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: Abril']],
                ],
            ],
            [
                'attributes' => [       // 1 column layout
                    'cdd' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: 48.194']],
                    'chamada' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Ex: 48.194.25']],
                ],
            ],
        ]
    ]);

    echo $model->isNewRecord ? FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [

                    [
                        'contentBefore' => '<legend class="text-info"><small>Cadastro de Acervo'
                        . '</small></legend>',
                        'attributes' => [
                            'catalogarAcervoExistente' => ['type' => Form::INPUT_DROPDOWN_LIST,
                                'items' => ['1' => 'Acervo Existente',
                                    '0' => 'Novo Acervo'],
                                'options' => ['prompt' =>
                                    'Selecione...',
                                    'disabled' => $model->isNewRecord ? false : true],
                            ],
                        ],
                    ],
                ]
            ]) : '';


    echo $model->isNewRecord ? FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [

                    [
                        'contentBefore' => '<legend class="text-info"><small>Exemplar</small></legend>',
                        'attributes' => [
                            'codigoInicio' => ['type' => Form::INPUT_HTML5,
                                'html5type' => 'number', 'options' =>
                                ['placeholder' => 'Digite o Código de Início', 'min' => 1, 'disabled' => $model->isNewRecord ? false : true]],
                            'codigoFim' => ['type' => Form::INPUT_HTML5,
                                'html5type' => 'number', 'options' =>
                                ['placeholder' => 'Digite o Código de Fim', 'min' => 1, 'disabled' => $model->isNewRecord ? false : true]],
                        ],
                    ],
                ]
            ]) : '';



    echo $model->isNewRecord ? FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [

                    [
                        'contentBefore' => '<legend class="text-info"><small>Exemplar</small></legend>',
                        'attributes' => [
                            'quantidadeExemplar' => ['type' => Form::INPUT_HTML5, 'html5type' => 'number', 'options' => ['placeholder' => 'Digite a Quantitade de Exemplares.', 'min' => 1, 'disabled' => $model->isNewRecord ? false : true]],
                        ],
                    ],
                ]
            ]) : '';
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Catalog') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $this->registerJsFile(\Yii::getAlias("@web") . '/js/js-acervo-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>

</div>