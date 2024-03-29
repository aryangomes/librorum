<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimos */
/* @var $form yii\widgets\ActiveForm */
/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="emprestimos-form">

    <script type="text/javascript">

        var maxQtdExemplarEmprestimo = <?= $maxQtdExemplarEmprestimo ?>;

    </script>

    <?php

    if (isset($mensagem) && !empty($mensagem)) {
        ?>
        <div class="alert alert-success">
            <?= $mensagem ?>
        </div>
        <?php

    }
    ?>

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    ?>

    <div id="mensagem-senha-errada"></div>
    <div id="mensagem-indisponivel-exemplar"></div>

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
    ?>
    <div id="result-get-usuario"></div>
    <div id="result-get-usuario"></div>
    <!-- ------------------ BEGIN Cadastro de Usuário ------------------ -->
    <?php
    Modal::begin([
        'header' => '<h2>Cadastrar Novo Usuário</h2>',
        'id' => 'modalcadastrarusuario',
        'size' => Modal::SIZE_LARGE,
    ]);
    ?>


    <legend class="text-info">
        <small>Usuário</small>
    </legend>
    <div class="row">
        <div class="col-sm-4">
            <?= Html::label('Nome') ?>
            <?=
            Html::input('text', 'Usuario[nome]', '', ['id' => 'usuario-nome-post',
                'class' => 'form-control'])
            ?>

        </div>


        <div class="col-sm-4">
            <?= Html::label('RG') ?>
            <?=
            Html::input('text', 'Usuario[rg]', '', ['id' => 'usuario-rg-post',
                'class' => 'form-control'])
            ?>

        </div>

        <div class="col-sm-4">
            <?= Html::label('CPF') ?>
            <?=
            MaskedInput::widget([
                'name' => 'Usuario[cpf]',
                'mask' => '999.999.999-99',
                'options' => ['id' => 'usuario-cpf-post',
                    'class' => 'form-control'],
            ]);
            ?>

        </div>
    </div>
    <legend class="text-info">
        <small>Contatos</small>
    </legend>
    <div class="row">

        <div class="col-sm-6">
            <?= Html::label('Telefone') ?>
            <?=
            MaskedInput::widget([
                'name' => 'Usuario[telefone]',
                'mask' => '(99)99999-9999',
                'options' => ['id' => 'usuario-telefone-post',
                    'class' => 'form-control'],
            ]);
            ?>

        </div>

        <div class="col-sm-6">
            <?= Html::label('Email') ?>
            <?=
            Html::input('text', 'Usuario[email]', '', ['id' => 'usuario-email-post',
                'class' => 'form-control'])
            ?>

        </div>

    </div>

    <legend class="text-info">
        <small>Dados Diversos</small>
    </legend>
    <div class="row">
        <div class="col-sm-3">
            <?= Html::label('Cargo') ?>
            <?=
            Html::input('text', 'Usuario[cargo]', '', ['id' => 'usuario-cargo-post',
                'class' => 'form-control'])
            ?>

        </div>

        <div class="col-sm-3">
            <?= Html::label('Repartição') ?>
            <?=
            Html::input('text', 'Usuario[reparticao]', '', ['id' => 'usuario-reparticao-post',
                'class' => 'form-control'])
            ?>

        </div>

        <div class="col-sm-3">
            <?= Html::label('Endereço') ?>
            <?=
            Html::input('text', 'Usuario[endereco]', '', ['id' => 'usuario-endereco-post',
                'class' => 'form-control'])
            ?>

        </div>

        <div class="col-sm-3">
            <?= Html::label('Situação Do Usuário') ?>

            <?=
            Html::dropDownList('Usuario[situacaoUsuarioIdsituacaoUsuario]', null, $situacoesusuario, ['id' => 'usuario-situacaousuario-post',
                'class' => 'form-control', 'prompt' => 'Selecione a Situação do Usuário'])
            ?>
        </div>


    </div>

    <legend class="text-info">
        <small>Dados Para Acesso Ao Sistema</small>
    </legend>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::label('Senha') ?>
            <?=
            Html::input('password', 'User[password]', '', ['id' => 'user-password-post',
                'class' => 'form-control'])
            ?>

        </div>

    </div>
    <p>
    <div class="form-group">
        <?=
        Html::Button(Yii::t('user', 'Create'), ['class' => 'btn btn-success',
            'id' => 'btCadastrarUsuario'])
        ?>
    </div>
    </p>
    <?php
    Modal::end();
    ?>
    <!-- ------------------ END Cadastro de Usuário ------------------ -->

    <?php
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
                    'actions' => [
                        'type' => Form::INPUT_RAW,
                        'value' => '<div class="col-sm-6"><div class="form-group ">
                            <label class="control-label" for="confirmar-usuario">Confirmar Usuário</label>
                            <input type="button" title="Clique aqui para confirmar os dados do Usuário" data-toggle="tooltip" id="confirmar-usuario" class="btn btn-primary" value="Confirmar">


	</div>'
                    ],
                ],
            ],
        ]
    ]);

    $tabDadosusuario = FormGrid::widget([
        'model' => $usuario,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [

            [
                'contentBefore' => '<legend class="text-info"><small>Informações do Usuário</small></legend>',
                'attributes' => [

                    'foto' => ['type' => Form::INPUT_RAW, 'value' => Html::img('../uploads/imgs/fotos-usuarios/userdefault.png', ['id' => 'foto-usuario',
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

    $tabBuscarUsuario = "<legend class=\"text-info\"><small>Pesquisar por Usuário</small></legend><div class=\"row\">
  <div class=\"col-lg-6\"> <div class=\"form-group\">
 <div class=\"input-group\">" .
        Html::input('text', 'busca-usuario', null, ['class' => 'form-control', 'id' => 'busca-usuario',
            'placeholder' => 'Digite o nome do usuário']) . "
 <span class=\"input-group-btn\"> 
  " . Html::button('Pesquisar', ['id' => 'btPesquisar', 'class' => 'btn btn-primary',
            'title' => 'Clique aqui para pesquisar o usuário',
            'data-toggle' => "tooltip"]) . "
 </span> </div> 
</div> </div> </div>
        <div id=\"result-mensagem-busca-usuario\">
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
                            ['placeholder' => 'Digite o código do exemplar',
                                'name' => 'AcervoExemplar[codigo_livro][]']
                        ],
                        'actions' => [
                            'type' => Form::INPUT_RAW,
                            'value' => '<div class="col-sm-6">
                <div class="form-group ">
                <label class="control-label" for="confirmar-usuario">Confirmar Exemplar</label>
                <input type="button" title="Clique aqui para confirmar os dados do Exemplar" data-toggle="tooltip" id="confirmar-exemplar" class="btn btn-primary" value="Confirmar">
                </div>
                <div class="form-group ">
              
                <input type="button" title="Clique aqui para adicionar mais um campo para informar um Código do Exemplar" 
                 data-toggle="tooltip" class="btn btn-success" 
                onclick="adicionarInputCodigoExemplar()" value="Adicionar mais um campo de Código Exemplar">
                </div>
                
                 <div class="form-group ">
              
                <input type="button" id="btRemoverInputCodigoExemplar"  class="btn btn-danger" 
                onclick="removerInputCodigoExemplar()" value="Remover um campo de Código Exemplar">
                </div>
                '
                        ],
                    ]
                ],
            ]
        ])
        . "<div id=\"mensagem-get-acervo-exemplar\"></div>";

    $tabBuscaExemplar = "<legend class=\"text-info\"><small>Pesquisar por Exemplar</small></legend> <div class=\"row\">
  <div class=\"col-lg-6\"> <div class=\"form-group\">
 <div class=\"input-group\">" .
        Html::input('text', 'busca-exemplar', null, ['class' => 'form-control', 'id' => 'busca-exemplar',
            'placeholder' => 'Digite o título do exemplar']) . "
 <span class=\"input-group-btn\"> 
  " . Html::button('Pesquisar', ['id' => 'btPesquisarExemplar', 'class' => 'btn btn-primary',
            'title' => 'Clique aqui para pesquisar o exemplar',
            'data-toggle' => "tooltip"]) . "
 </span> </div></div></div></div>
         

        <div id=\"result-mensagem-busca-exemplar\">
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
        </table> 
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
    ?>


    <?php
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
                ],
            ],
        ]
    ]);
    ?>

    <!--   ---------------------------   BEGIN Configurar Dias Empréstimo  ---------------------------  -->
    <?php
    Modal::begin([
        'header' => '<h2>Configurar Dias de Empréstimo</h2>',
        'id' => 'modalconfigurardiasemprestimo',
    ]);
    ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group">

                <?=
                Html::input('number', 'Config[valor]', '', ['min' => 1, 'class' => 'form-control',
                    'placeholder' => 'Digite o número de dias', 'id' => 'config-valor'])
                ?>
                <span class="input-group-btn">
                <?=
                Html::Button(Yii::t('app', 'Update'), ['class' => 'btn btn-primary',
                    'id' => 'btConfigurarDiasEmprestimo'])
                ?>
            </span>
            </div>
        </div>
    </div>


    <?php
    Modal::end();
    ?>

    <!--   ---------------------------   END Configurar Dias Empréstimo  ---------------------------  -->
    <div id="mensagem-get-data-previsao"></div>
    <?php
    $items = [
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> Dados do Usuário',
            'content' => $tabBuscarUsuario . $tabUsuario . $tabSenhadoUsuario . $tabDadosusuario,
            'active' => true,
            'options' => ['id' => 'tab-usuario']
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> Dados do Exemplar',
            'content' => $tabBuscaExemplar . $tabExemplar,
            'options' => ['id' => 'tab-exemplar']
        ],
        [
            'label' => '<i class="glyphicon glyphicon-edit"></i> Dados do Empréstimo',
            'content' => $tabAcervo . $tabEmprestimo,
            'options' => ['id' => 'tab-emprestimo']
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

            <div class="form-group">
                <?= Html::label("Senha") ?>
                <?=
                Html::passwordInput('user-password', '', ['maxlength' => true, 'class' => 'form-control',
                    'placeholder' => 'Digite a nova senha', 'id' => 'user-newpassword'])
                ?>
            </div>
            <div class="form-group">
                <?= Html::label("Confirmar Senha") ?>
                <?=
                Html::passwordInput('user-newpassword-confirm', '', ['maxlength' => true, 'class' => 'form-control',
                    'placeholder' => 'Digite a nova senha', 'id' => 'user-newpassword-confirm'])
                ?>
            </div>
            <div class="form-group">

                <?= Html::Button(Yii::t('app', 'Alterar Senha'), ['class' => 'btn btn-primary', 'id' => 'btAlterarSenha']) ?>

            </div>
        </div>
    </div>


    <div id="mensagem-resetar-senha"></div>

    <?php
    Modal::end();
    ?>
    <!--    Alterar Senha     -->

    <?= $form->field($usuario, 'user_id')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'usuario_idusuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'usuario_rg')->hiddenInput(['id' => 'rgusuario'])->label(false) ?>

    <?= $form->field($model, 'usuario_nome')->hiddenInput(['id' => 'nomeusuario'])->label(false) ?>


    <?= $form->field($model, 'dataprevisaodevolucao')->hiddenInput()->label(false) ?>
</div>

<div class="form-group">
    <?=
    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
        'id' => 'btSave',
        'title' => $model->isNewRecord ? 'Clique aqui cadastrar o Empréstimo' : 'Clique aqui atualizar o Empréstimo',
        'data-toggle' => "tooltip"])
    ?>


    <?= Html::resetButton('Limpar', ['class' => 'btn btn-warning',
        'title' => 'Clique aqui para limpar os dados dos campos',
        'data-toggle' => "tooltip"])
    ?>
</div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJsFile(\Yii::getAlias("@web") . '/js/js-emprestimo-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
            $('#foto-usuario').attr("src", usuario.foto);
            $('#w14 li:eq(0)').removeClass();
            $('#w13 li:eq(0)').addClass("active");
            $("#w13-dd3-tab0").removeClass();
            $("#w13-dd3-tab0").addClass("tab-pane fade");
            $("#tab-usuario").addClass("tab-pane fade in active");
            $("#result-mensagem-busca-usuario").hide();
            $("#tableresult").hide();
            $("#emprestimo-usuario_rg").focus();
        });

    }

    function actionSelecionarExemplar(codigoExemplar) {

        $('#acervoexemplar-codigo_livro').val(codigoExemplar);
        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {

            var exemplar = $.parseJSON(data);
            console.log(exemplar);
            $('#acervoexemplar-codigo_livro').val(codigoExemplar);
            //$('#emprestimo-acervo_exemplar_idacervo_exemplar').val(exemplar[0].idacervo_exemplar);
            $('#acervo-titulo').val(exemplar[1].titulo);
            $('#acervo-autor').val(exemplar[1].autor);
            $('#w14 li:eq(1)').removeClass();
            $('#w13 li:eq(1)').addClass("active");
            $("#w13-dd3-tab1").removeClass();
            $("#w13-dd3-tab1").addClass("tab-pane fade");
            $("#tab-exemplar").addClass("tab-pane fade in active");
            $('#acervoexemplar-codigo_livro').focus();
        });

    }


</script>