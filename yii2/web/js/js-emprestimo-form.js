/**
 * Created by aryan on 03/07/16.
 */


$('#tableresult').hide();
$('#tableresult-exemplar').hide();

$('#emprestimo-usuario_rg').blur(function () {
    var
        rg = $(this).val();
    if (rg != ' ') {


        $.get('get-usuario', {rg: rg}, function (data) {

            var
                data = $.parseJSON(data);

            if (data != null) {
                $('#rgusuario').val(rg);
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


$('#acervoexemplar-codigo_livro').blur(function () {
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
                    $("#message-indisponivel-exemaplar").html("<div class=\"alert alert-warning\" role=\"alert\">" +
                        "<strong>Alerta!</strong> Exemplar indisponível no momento." +
                        "</div>");
                    $('button[type="submit"]').prop('disabled', true);

                } else {
                    $("#message-indisponivel-exemaplar").html("");
                    $('button[type="submit"]').prop('disabled', false);
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

$('#busca-usuario').blur(function () {
    var buscausuario = $(this).val();
    console.log('buscausuario.:' + buscausuario.length);
    if (buscausuario != ' ' && buscausuario.length > 0) {


        $.get('get-busca-usuario', {nomeUsuario: buscausuario}, function (data) {

            var data = $.parseJSON(data);
            console.log(data);
            if (data.length > 0) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>Matrículas encontradas</b>');
                data.forEach(function (item) {
                    console.log('rg.:' + item.rg);
                    $('#tbody-result').append(
                        '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(\"' + item.rg + '\")\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
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

$('#btPesquisar').click(function () {
    var buscausuario = $(this).val();
    console.log('buscausuario.:' + buscausuario.length);
    if (buscausuario != ' ' && buscausuario.length > 0) {


        $.get('get-busca-usuario', {nomeUsuario: buscausuario}, function (data) {

            var data = $.parseJSON(data);
            console.log(data);
            if (data.length > 0) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>Matrículas encontradas</b>');
                data.forEach(function (item) {
                    console.log('rg.:' + item.rg);
                    $('#tbody-result').append(
                        '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(\"' + item.rg + '\")\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
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

$('#busca-exemplar').blur(function () {
    var buscaexemplar = $(this).val();
    console.log('buscaexemplar.:' + buscaexemplar.length);
    if (buscaexemplar != ' ' && buscaexemplar.length > 0) {


        $.get('get-busca-exemplar', {tituloExemplar: buscaexemplar}, function (data) {

            var data = $.parseJSON(data);
            // console.log(data);
            if (data.length > 0) {
                $('#tableresult-exemplar').show();
                $('#tbody-result-exemplar').html('');
                $('#result-messagem-busca-exemplar').attr('class', 'alert alert-success');
                $('#result-messagem-busca-exemplar').html('</b>Exemplares encontrados</b>');
                var codigoslivro = [];
                var titulos = [];
                var autores = [];
                data[0].forEach(function (item) {
                    console.log(item);
                   
                    codigoslivro.push(item.codigo_livro);

                });
                data[1].forEach(function (item) {
                    console.log(item);

                    titulos.push(item.titulo);
                    autores.push(item.autor);

                });
                codigoslivro.forEach(function (item,index) {
                    $('#tbody-result-exemplar') . append(
                        '<tr><td>'+titulos[index]+'</td><td>'+autores[index]+'</td><td>'+codigoslivro[index]+'</td><td><a href=\'#\' onclick=\'actionSelecionarExemplar(\"'+codigoslivro[index]+'\")\' class=\'btn btn-success\' id=\'actionbuscarexemplar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });


            } else {
                data = null;
                $('#tableresult-exemplar').hide();
                $('#tbody-result-exemplar').html('');
                $('#result-messagem-busca-exemplar').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-exemplar').html('Nenhum exemplar encontrado');
            }
        });
    }
});

$('#btPesquisarExemplar').blur(function () {
    var buscaexemplar = $(this).val();
    console.log('buscaexemplar.:' + buscaexemplar.length);
    if (buscaexemplar != ' ' && buscaexemplar.length > 0) {


        $.get('get-busca-exemplar', {tituloExemplar: buscaexemplar}, function (data) {

            var data = $.parseJSON(data);
            // console.log(data);
            if (data.length > 0) {
                $('#tableresult-exemplar').show();
                $('#tbody-result-exemplar').html('');
                $('#result-messagem-busca-exemplar').attr('class', 'alert alert-success');
                $('#result-messagem-busca-exemplar').html('</b>Exemplares encontrados</b>');
                var codigoslivro = [];
                var titulos = [];
                var autores = [];
                data[0].forEach(function (item) {
                    console.log(item);

                    codigoslivro.push(item.codigo_livro);

                });
                data[1].forEach(function (item) {
                    console.log(item);

                    titulos.push(item.titulo);
                    autores.push(item.autor);

                });
                codigoslivro.forEach(function (item,index) {
                    $('#tbody-result-exemplar') . append(
                        '<tr><td>'+titulos[index]+'</td><td>'+autores[index]+'</td><td>'+codigoslivro[index]+'</td><td><a href=\'#\' onclick=\'actionSelecionarExemplar(\"'+codigoslivro[index]+'\")\' class=\'btn btn-success\' id=\'actionbuscarexemplar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });


            } else {
                data = null;
                $('#tableresult-exemplar').hide();
                $('#tbody-result-exemplar').html('');
                $('#result-messagem-busca-exemplar').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-exemplar').html('Nenhum exemplar encontrado');
            }
        });
    }
});
