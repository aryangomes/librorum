<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Emprestimos */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="emprestimos-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'usuario_rg')->textInput(['placeholder' => 'Digite RG do Usuário']) ?>

    <?= $form->field($model, 'usuario_nome')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'usuario_idusuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'usuario_nome')->hiddenInput(['id' => 'nomeusuario'])->label(false) ?>

    <?= $form->field($usuario, 'cpf')->textInput(['disabled' => true]) ?>

    <?= $form->field($usuario, 'cargo')->textInput(['disabled' => true]) ?>

    <?= $form->field($usuario, 'reparticao')->textInput(['disabled' => true]) ?>

    <?= $form->field($exemplar, 'codigo_livro')->textInput(
        ['placeholder' => 'Digite o código do exemplar']
    ) ?>


    <?= $form->field($model, 'acervo_exemplar_idacervo_exemplar')->hiddenInput()->label(false) ?>


    <?= $form->field($acervo, 'titulo')->textInput(['disabled' => true]) ?>

    <?= $form->field($acervo, 'autor')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'dataemprestimo')->textInput(['disabled' => true,
        'value' => date('d/m/Y H:i:s', strtotime($model->dataemprestimo))]) ?>

    <div class="form-group">
        <?= $form->field($model, 'dataprevisaodevolucao')->hiddenInput()->label(false) ?>

        <?= Html::label("Data de previsão da devolução") ?>

        <?= Html::input("text", null, null, ["id" => "lb-dataprevisaodevolucao", 'class' => "form-control",
            'disabled' => true]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <!--   Busca de Usuário     -->
        <?php
        Modal::begin([
            'header' => '<h2>Buscar Usuário</h2>',
            'toggleButton' => ['label' => 'Buscar Usuário', 'class' => 'btn btn-primary',],

        ]);

        $form = ActiveForm::begin();

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
        ActiveForm::end();

        Modal::end();
        ?>
        <!--    Busca de Usuário      -->
        <?= Html::resetButton('Limpar',
            ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJs("

    $('#tableresult') . hide();

$('#emprestimo-usuario_rg') . keyup(function () {
    var
    rg = $(this) . val();
    if (rg != ' ') {


        $.get('get-usuario',{rg : rg}, function (data){

            var
            data = $.parseJSON(data);

            if (data != null) {

                $('#usuario-cpf') . val(data . cpf);
                $('#emprestimo-usuario_nome') . val(data . nome);
                $('#nomeusuario') . val(data . nome);
                $('#usuario-cargo') . val(data . cargo);
                $('#usuario-reparticao') . val(data . reparticao);
                $('#emprestimo-usuario_idusuario') . val(data.idusuario);

            }
        });
    }
});

$('#emprestimo-usuario_rg') . change(function () {
    var
    rg = $(this) . val();
    if (rg != ' ') {


        $.get('get-usuario',{rg : rg}, function (data){

            var
            data = $.parseJSON(data);

            if (data != null) {

                $('#usuario-cpf') . val(data . cpf);
                $('#emprestimo-usuario_nome') . val(data . nome);
                $('#nomeusuario') . val(data . nome);
                $('#usuario-cargo') . val(data . cargo);
                $('#usuario-reparticao') . val(data . reparticao);
                $('#emprestimo-usuario_idusuario') . val(data.idusuario);

            }
        });
    }
});

$('#acervoexemplar-codigo_livro') . keyup(function () {
    var
    codigoExemplar = $(this) . val();
    if (codigoExemplar != ' ') {


        $.get('get-exemplar',{codigoExemplar : codigoExemplar}, function (data){


            var
            data = $.parseJSON((data));
            if (data != null) {
                $('#acervo-titulo') . val(data . titulo);
                $('#acervo-autor') . val(data . autor);
            }

        });
    }
});


$('#acervoexemplar-codigo_livro') . change(function () {
    var
    codigoExemplar = $(this) . val();
    if (codigoExemplar != ' ') {


        $.get('get-exemplar',{codigoExemplar : codigoExemplar}, function (data){


            var
            data = $.parseJSON((data));
            if (data != null) {
          
                $('#acervo-titulo') . val(data[1] . titulo);
                $('#acervo-autor') . val(data[1] . autor);
                 $('#emprestimo-acervo_exemplar_idacervo_exemplar') . val(data[0] . idacervo_exemplar);
                
            }


        });
    }
});
$.get('get-data-previsao-devolucao' , function (data){
    console . log('previsao.: ' + data);

    var
    data = $.parseJSON((data));
    $('#emprestimo-dataprevisaodevolucao') . val(data[0]);
    $('#lb-dataprevisaodevolucao') . val(data[1]);


});

$('#busca-usuario') . keyup(function () {
    var
    buscausuario = $(this) . val();

    if (buscausuario != ' ') {


        $.get('get-busca-usuario',{nomeUsuario : buscausuario}, function (data){

            var
            data = $.parseJSON(data);

            if (data . length > 0) {
                $('#tableresult') . show();
                $('#tbody-result') . html('');

                $('#usuario-rg') . val(data . rg);
                $('#result-messagem-busca-usuario') . attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario') . html('</b>Matrículas encontradas</b>');
                data .forEach(function (item){
                    $('#tbody-result') . append(
                        '<tr><td>' + item . nome + '</td><td>' + item . rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(' + item . rg + ')\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class=\"glyphicon glyphicon-ok\"></span></a ></td></tr>');
                });
                            
                         $.get('get-usuario',{rg : data . rg}, function (data){

                    var
                    usuario = $.parseJSON(data);

                    $('#usuario-curso_idcurso') . val(usuario[2] . nome_curso);
                    $('#usuario-nome') . val(usuario[0] . nome);
                    $('#usuario-situacao_usuario_idsituacao_usuario') . val(usuario[1] . situacao);
                    $('#usuario-observacao') . val(usuario[0] . observacao);
                    $('#emprestimos-usuario_idusuario') . val(usuario[0] . idusuario);
                    $('#usuario-departamento_iddepartamento') . val(usuario[3] . nome_departamento);

                });
                    } else {
                data = null;
                $('#tableresult') . hide();
                $('#tbody-result') . html('');
                $('#result-messagem-busca-usuario') . attr('class', 'alert alert-danger');
                $('#result-messagem-busca-usuario') .
                html('Nenhuma matrícula encontrada');
            }
        });
    }
});

$('#busca-usuario') . change(function () {

    var
    buscausuario = $(this) . val();

    if (buscausuario != ' ') {


        $.get('get-busca-usuario',{nomeUsuario : buscausuario}, function (data){

            var
            data = $.parseJSON(data);

            if (data . length > 0) {
                $('#tableresult') . show();
                $('#tbody-result') . html('');

                $('#usuario-rg') . val(data . rg);
                $('#result-messagem-busca-usuario') . attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario') . html('</b>Matrículas encontradas</b>');
                data .forEach(function (item){
                    $('#tbody-result') . append(
                        '<tr><td>' + item . nome + '</td><td>' + item . rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(' + item . rg + ')\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class=\"glyphicon glyphicon-ok\"></span></a ></td></tr>');
                });
                         
                        
                    } else {
                data = null;
                $('#tableresult') . hide();
                $('#tbody-result') . html('');
                $('#result-messagem-busca-usuario') . attr('class', 'alert alert-danger');
                $('#result-messagem-busca-usuario') .
                html('Nenhuma matrícula encontrada');
            }
        });
    }
});


");
    ?>
</div>

<script type="application / javascript">
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