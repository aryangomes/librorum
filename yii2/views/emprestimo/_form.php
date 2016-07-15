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
    ?>

    <?php


    use kartik\tabs\TabsX;

    $tabUsuario = FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'contentBefore' => '<legend class="text-info"><small>Usuário</small></legend>',
                'attributes' => [

                    'usuario_rg' => ['type' => Form::INPUT_TEXT,],
                    'usuario_nome' => ['type' => Form::INPUT_TEXT, 'options' =>
                        ['disabled' => true]
                    ],


                ],

            ],


        ]
    ]);

    $tabSenhadoUsuario = FormGrid::widget([
            'model' => $user,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'contentBefore' => '<legend class="text-info"><small>Senha do Usuário</small></legend>',
                    'attributes' => [

                        'password' => ['type' => Form::INPUT_PASSWORD, 'options' =>
                            ['value' => '']
                        ],


                    ],

                ],


            ]
        ]) . " <div id=\"message-senha-errada\"></div>";

    $tabDadosusuario = FormGrid::widget([
        'model' => $usuario,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Informações do Usuário</small></legend>',
                'attributes' => [

                    'foto' => ['type' => Form::INPUT_RAW, 'value' => Html::img('#', ['id' => 'foto-usuario',
                        'class' => "img-thumbnail img-responsive", 'width' => "304", 'height' => "236",
                    ]),
                    ],
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

    $tabBuscarUsuario = "<div class=\"row\">
  <div class=\"col-lg-6\"> <div class=\"form-group\">
 <div class=\"input-group\">" .
        Html::input('text', 'busca-usuario', null, ['class' => 'form-control', 'id' => 'busca-usuario',
            'placeholder' => 'Digite o nome do usuário']) . "
 <span class=\"input-group-btn\"> 
  " . Html::button('Pesquisar', ['id' => 'btPesquisar', 'class' => 'btn btn-primary']) . "
 </span> </div> 
</div> </div> </div>
        <div id=\"result-messagem-busca-usuario\">
        </div>
        <table id=\"tableresult\" class=\"table table-bordered\">
            <thead>
            <tr>
                <th>Nome</th>
                <th>RG</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id=\"tbody-result\">

            </tbody>
        </table>";


    $tabExemplar = FormGrid::widget([
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
        ]) . "  <div id=\"message-indisponivel-exemaplar\"> </div>";

    $tabBuscaExemplar = " <div class=\"row\">
  <div class=\"col-lg-6\"> <div class=\"form-group\">
 <div class=\"input-group\">" .
        Html::input('text', 'busca-exemplar', null, ['class' => 'form-control', 'id' => 'busca-exemplar',
            'placeholder' => 'Digite o título do exemplar']) . "
 <span class=\"input-group-btn\"> 
  " . Html::button('Pesquisar', ['id' => 'btPesquisarExemplar', 'class' => 'btn btn-primary']) . "
 </span> </div></div></div></div>
         

        <div id=\"result-messagem-busca-exemplar\">
        </div>
        <table id=\"tableresult-exemplar\" class=\"table table-bordered\">
            <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Código Exemplar</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id=\"tbody-result-exemplar\">

            </tbody>
        </table> <div id=\"message-indisponivel-exemaplar\">


        </div>
";

    $tabAcervo = FormGrid::widget([
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


    $tabEmprestimo = FormGrid::widget([
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
                        ['disabled' => true, "id" => "lb-dataprevisaodevolucao",
                        ]
                    ],

                ]
            ],

        ]
    ]);

    $items = [
        [
            'label' => '<i class="glyphicon glyphicon-home"></i> Dados do Usuário',
            'content' => $tabUsuario . $tabSenhadoUsuario . $tabDadosusuario,
            'active' => true,
            'options' => ['id' => 'tab-usuario']
        ],
        [
            'label' => '<i class="glyphicon glyphicon-home"></i> Dados do Exemplar',
            'content' => $tabExemplar . $tabAcervo,
            'options' => ['id' => 'tab-exemplar']

        ],
        [
            'label' => '<i class="glyphicon glyphicon-home"></i> Dados do Empréstimo',
            'content' => $tabEmprestimo,
            'options' => ['id' => 'tab-emprestimo']
        ],
        [
            'label' => '<i class="glyphicon glyphicon-list-alt"></i> Realizar busca',
            'items' => [
                [
                    'label' => 'Buscar Usuário',
                    'encode' => false,
                    'content' => $tabBuscarUsuario,
                    'options' => ['id' => 'tab-busca-usuario']
                ],
                [
                    'label' => 'Buscar Exemplar',
                    'encode' => false,
                    'content' => $tabBuscaExemplar,
                    'options' => ['id' => 'tab-busca-exemplar']
                ],
            ],
        ],

    ];
    // Above
    echo TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]);
    ?>

    <!--   Alterar Senha     -->
    <?php
    Modal::begin([
        'header' => '<h2>Cadastrar Nova Senha</h2>',
        'id' => 'modalalterarsenha',
    ]);
    ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group">

                <?= Html::passwordInput('user-password', '', ['maxlength' => true, 'class' => 'form-control',
                    'placeholder' => 'Digite a nova senha', 'id' => 'user-newpassword']) ?>
                <span class="input-group-btn">
        <?= Html::Button(Yii::t('app', 'Update'), ['class' => 'btn btn-primary', 'id' => 'btAlterarSenha']) ?>
      </span>
            </div>
        </div>
    </div>


    <div id="message-resetar-senha"></div>

    <?php
    Modal::end();
    ?>
    <!--    Alterar Senha     -->

    <?= $form->field($usuario, 'user_id')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'usuario_idusuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'usuario_rg')->hiddenInput(['id' => 'rgusuario'])->label(false) ?>

    <?= $form->field($model, 'usuario_nome')->hiddenInput(['id' => 'nomeusuario'])->label(false) ?>

    <?= $form->field($model, 'acervo_exemplar_idacervo_exemplar')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'dataprevisaodevolucao')->hiddenInput()->label(false) ?>
</div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'id' => 'btSave']) ?>


    <?= Html::resetButton('Limpar',
        ['class' => 'btn btn-warning']) ?>
</div>

<?php ActiveForm::end(); ?>
<?php
$this->registerJsFile(\Yii::getAlias("@web") . '/js/js-emprestimo-form.js',
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
            $('#usuario-user_id').val(usuario.user_id);
            $('#foto-usuario').attr("src", data.foto);
            $('#w14 li:eq(0)').removeClass();
            $('#w13 li:eq(0)').addClass("active");
            $("#w13-dd3-tab0").removeClass();
            $("#w13-dd3-tab0").addClass("tab-pane fade");
            $("#tab-usuario").addClass("tab-pane fade in active");

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
            $('#w14 li:eq(1)').removeClass();
            $('#w13 li:eq(1)').addClass("active");
            $("#w13-dd3-tab1").removeClass();
            $("#w13-dd3-tab1").addClass("tab-pane fade");
            $("#tab-exemplar").addClass("tab-pane fade in active");
        });

    }


</script>