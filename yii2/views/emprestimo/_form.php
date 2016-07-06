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

    <!--   Busca de Usuário     -->
    <?php
    Modal::begin([
        'header' => '<h2>Buscar Usuário</h2>',
        'toggleButton' => ['label' => 'Buscar Usuário', 'class' => 'btn btn-primary btn-block',],

    ]);

    ?>
    <div class="form-group">
        <?= Html::label('Nome do usuário', 'busca-usuario') ?>

        <?= Html::input('text', 'busca-usuario', null, ['class' => 'form-control', 'id' => 'busca-usuario',
            'placeholder' => 'Digite o nome do usuário']) ?>

    </div>
    <div id="result-messagem-busca-usuario">
    </div>
    <table id="tableresult" class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Matrícula</th>
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
                'id'=>'btCreate']) ?>


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
        $('#usuario-rg').val(rg);
        $.get('get-usuario', {rg: rg}, function (data) {

            var
                usuario = $.parseJSON(data);

            $('#usuario-curso_idcurso').val(usuario[2].nome_curso);
            $('#usuario-nome').val(usuario[0].nome);
            $('#usuario-situacao_usuario_idsituacao_usuario').val(usuario[1].situacao);
            $('#usuario-observacao').val(usuario[0].observacao);
            $('#emprestimos-usuario_idusuario').val(usuario[0].idusuario);
            $('#usuario-departamento_iddepartamento').val(usuario[3].nome_departamento);

        });

    }



</script>