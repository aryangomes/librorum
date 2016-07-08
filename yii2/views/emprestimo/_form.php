<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimos */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="emprestimos-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);

    echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Usuário</small></legend>',
                'attributes' => [

                    'usuario_rg' => ['type' => Form::INPUT_WIDGET,'widgetClass' => '\yii\widgets\MaskedInput', 'options' =>
                        [ 'mask' => ['99.999.999-9']]
                    ],
                    'usuario_nome' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],


                ],

            ],


        ]
    ]);
    ?>

    <?= FormGrid::widget([
        'model' => $user,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Senha do Usuário</small></legend>',
                'attributes' => [

                    'password' => ['type' => Form::INPUT_PASSWORD, 'options'=>
                    ['value'=>'']
                    ],


                ],

            ],


        ]
    ]);?>

    <div id="message-senha-errada">


    </div>
    
    <!--   Busca de Usuário     -->
    <?php
    Modal::begin([
        'header' => '<h2>Buscar Usuário</h2>',
        'toggleButton' => ['label' => 'Buscar Usuário', 'class' => 'btn btn-primary btn-block',],

    ]);

    ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Nome do usuário', 'busca-usuario') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= Html::input('text', 'busca-usuario', null, ['class' => 'form-control', 'id' => 'busca-usuario',
                    'placeholder' => 'Digite o nome do usuário']) ?>
            </div>
            <div class="col-md-2">
                <?= Html::button('Pesquisar', ['id'=>'btPesquisar','class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <div id="result-messagem-busca-usuario">
    </div>
    <table id="tableresult" class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>RG</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody id="tbody-result">

        </tbody>
    </table>


    <?php


    Modal::end();
    ?>
    <!--    Busca de Usuário      -->

    <?= FormGrid::widget([
        'model' => $usuario,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Informações do Usuário</small></legend>',
                'attributes' => [

                    'cpf' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],
                    'cargo' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],
                    'reparticao' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],


                ]
            ],

        ]
    ]);
    ?>
    <?= $form->field($usuario, 'user_id')->hiddenInput()->label(false) ?>

    <?= FormGrid::widget([
        'model' => $exemplar,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Código Exemplar</small></legend>',
                'attributes' => [

                    'codigo_livro' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['placeholder' => 'Digite o código do exemplar']
                    ],


                ]
            ],

        ]
    ]);
    ?>

    <!--   Busca de Exemplar     -->
    <?php
    Modal::begin([
        'header' => '<h2>Buscar Usuário</h2>',
        'toggleButton' => ['label' => 'Buscar Exemplar', 'class' => 'btn btn-primary btn-block',],

    ]);

    ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Nome do usuário', 'busca-exemplar') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= Html::input('text', 'busca-exemplar', null, ['class' => 'form-control', 'id' => 'busca-exemplar',
                    'placeholder' => 'Digite o título do exemplar']) ?>
            </div>
            <div class="col-md-2">
                <?= Html::button('Pesquisar', ['id'=>'btPesquisarExemplar','class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <div id="result-messagem-busca-exemplar">
    </div>
    <table id="tableresult-exemplar" class="table table-bordered">
        <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Código Exemplar</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody id="tbody-result-exemplar">

        </tbody>
    </table>


    <?php


    Modal::end();
    ?>
    <!--    Busca de Exemplar      -->

    <div id="message-indisponivel-exemaplar">


    </div>
    <?= FormGrid::widget([
        'model' => $acervo,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Informações do Exemplar</small></legend>',
                'attributes' => [

                    'titulo' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],

                    'autor' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],

                ]
            ],

        ]
    ]);
    ?>

    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Informações sobre o Empréstimo</small></legend>',
                'attributes' => [

                    'dataemprestimo' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true,
                            'value' => date('d/m/Y H:i:s', strtotime($model->dataemprestimo))]
                    ],

                    'dataprevisaodevolucao' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true,"id" => "lb-dataprevisaodevolucao",
                        ]
                    ],

                ]
            ],

        ]
    ]);
    ?>


    <?= $form->field($model, 'usuario_idusuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'usuario_rg')->hiddenInput(['id' => 'rgusuario'])->label(false) ?>

    <?= $form->field($model, 'usuario_nome')->hiddenInput(['id' => 'nomeusuario'])->label(false) ?>

    <?= $form->field($model, 'acervo_exemplar_idacervo_exemplar')->hiddenInput()->label(false) ?>

    <div id="message-indisponivel-exemaplar">


    </div>

    <?= $form->field($model, 'dataprevisaodevolucao')->hiddenInput()->label(false) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'id'=>'btSave']) ?>


        <?= Html::resetButton('Limpar',
            ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(\Yii::getAlias("@web").'/js/js-emprestimo-form.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>
</div>

<script type="application/javascript">
    function actionSelecionarUsuario(rg) {

        $('#emprestimo-usuario_rg').val(rg);
        $.get('get-usuario', {rg: rg}, function (data) {

            var usuario = $.parseJSON(data);
            $('#usuario-rg').val(usuario.rg);
            $('#rgusuario').val(usuario.rg);
            $('#emprestimo-usuario_nome').val(usuario.nome);
            $('#nomeusuario').val(usuario.nome);
            $('#usuario-cpf').val(usuario.cpf);
            $('#usuario-cargo').val(usuario.cargo);
            $('#usuario-reparticao').val(usuario.reparticao);
            $('#emprestimo-usuario_idusuario').val(usuario.idusuario);
            $('#usuario_idusuario').val(usuario.idusuario);
            console.log('usuario.idusuario.:'+usuario.idusuario);

        });

    }

    function actionSelecionarExemplar(codigoExemplar) {

        $('#acervoexemplar-codigo_livro').val(codigoExemplar);
        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {

            var exemplar = $.parseJSON(data);
            console.log(exemplar);
            $('#acervoexemplar-codigo_livro').val(codigoExemplar);
            $('#emprestimo-acervo_exemplar_idacervo_exemplar').val(exemplar[0].idacervo_exemplar);
            $('#acervo-titulo').val(exemplar[1].titulo);
            $('#acervo-autor').val(exemplar[1].autor);

        });

    }



</script>