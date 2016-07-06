/**
 * Created by aryan on 03/07/16.
 */


$('#tableresult').hide();

$('#emprestimo-usuario_rg').keyup(function () { 
    var
        rg = $(this).val();
    if (rg != ' ') {


        $.get('get-usuario', {rg: rg}, function (data) {

            var
                data = $.parseJSON(data);

            if (data != null) {

                $('#usuario-cpf').val(data.cpf);
                $('#emprestimo-usuario_nome').val(data.nome);
                $('#nomeusuario').val(data.nome);
                $('#usuario-cargo').val(data.cargo);
                $('#usuario-reparticao').val(data.reparticao);
                $('#emprestimo-usuario_idusuario').val(data.idusuario);

            }
        });
    }
});

$('#emprestimo-usuario_rg').change(function () {
    var
        rg = $(this).val();
    if (rg != ' ') {


        $.get('get-usuario', {rg: rg}, function (data) {

            var
                data = $.parseJSON(data);

            if (data != null) {

                $('#usuario-cpf').val(data.cpf);
                $('#emprestimo-usuario_nome').val(data.nome);
                $('#nomeusuario').val(data.nome);
                $('#usuario-cargo').val(data.cargo);
                $('#usuario-reparticao').val(data.reparticao);
                $('#emprestimo-usuario_idusuario').val(data.idusuario);

            }
        });
    }
});

$('#acervoexemplar-codigo_livro').keyup(function () {
    var
        codigoExemplar = $(this).val();
    if (codigoExemplar != ' ') {


        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {


            var
                data = $.parseJSON((data));
            if (data != null) {
                $('#acervo-titulo').val(data[1].titulo);
                $('#acervo-autor').val(data[1].autor);
                $('#emprestimo-acervo_exemplar_idacervo_exemplar').val(data[0].idacervo_exemplar);
                if (!(data[0].esta_disponivel)) {
                    $("#message-indisponivel-exemaplar").html("<div class=\"alert alert-warning\" role=\"alert\">"+
                    "<strong>Alerta!</strong> Exemplar indisponível no momento."+
                    "</div>");
                    $('button[type="submit"]').prop('disabled',true);

                }else{
                    $("#message-indisponivel-exemaplar").html("");
                    $('button[type="submit"]').prop('disabled',false);
                }
            }

        });
    }
});


$('#acervoexemplar-codigo_livro').change(function () {
    var
        codigoExemplar = $(this).val();
    if (codigoExemplar != ' ') {


        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {


            var
                data = $.parseJSON((data));
            if (data != null) {

                $('#acervo-titulo').val(data[1].titulo);
                $('#acervo-autor').val(data[1].autor);
                $('#emprestimo-acervo_exemplar_idacervo_exemplar').val(data[0].idacervo_exemplar);
                $("#message-indisponivel-exemaplar").html("");
                if (!(data[0].esta_disponivel)) {
                    $("#message-indisponivel-exemaplar").html("<div class=\"alert alert-warning\" role=\"alert\">"+
                        "<strong>Alerta!</strong> Exemplar indisponível no momento."+
                        "</div>");
                    $('button[type="submit"]').prop('disabled',true);

                }else{
                    $("#message-indisponivel-exemaplar").html("");
                    $('button[type="submit"]').prop('disabled',false);
                }

            }


        });
    }
});
$.get('get-data-previsao-devolucao', function (data) {
    console.log('previsao.: ' + data);

    var
        data = $.parseJSON((data));
    $('#emprestimo-dataprevisaodevolucao').val(data[0]);
    $('#lb-dataprevisaodevolucao').val(data[1]);


});

$('#busca-usuario').keyup(function () {
    var
        buscausuario = $(this).val();

    if (buscausuario != ' ') {


        $.get('get-busca-usuario', {nomeUsuario: buscausuario}, function (data) {

            var
                data = $.parseJSON(data);

            if (data.length > 0) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>Matrículas encontradas</b>');
                data.forEach(function (item) {
                    $('#tbody-result').append(
                        '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(' + item.rg + ')\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });

                $.get('get-usuario', {rg: data.rg}, function (data) {

                    var
                        usuario = $.parseJSON(data);

                    $('#usuario-curso_idcurso').val(usuario[2].nome_curso);
                    $('#usuario-nome').val(usuario[0].nome);
                    $('#usuario-situacao_usuario_idsituacao_usuario').val(usuario[1].situacao);
                    $('#usuario-observacao').val(usuario[0].observacao);
                    $('#emprestimos-usuario_idusuario').val(usuario[0].idusuario);
                    $('#usuario-departamento_iddepartamento').val(usuario[3].nome_departamento);

                });
            } else {
                data = null;
                $('#tableresult').hide();
                $('#tbody-result').html('');
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-usuario').html('Nenhuma matrícula encontrada');
            }
        });
    }
});

$('#busca-usuario').change(function () {

    var
        buscausuario = $(this).val();

    if (buscausuario != ' ') {


        $.get('get-busca-usuario', {nomeUsuario: buscausuario}, function (data) {

            var
                data = $.parseJSON(data);

            if (data.length > 0) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>Matrículas encontradas</b>');
                data.forEach(function (item) {
                    $('#tbody-result').append(
                        '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(' + item.rg + ')\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });


            } else {
                data = null;
                $('#tableresult').hide();
                $('#tbody-result').html('');
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-usuario').html('Nenhuma matrícula encontrada');
            }
        });
    }
});