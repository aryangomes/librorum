/**
 * Created by aryan on 03/07/16.
 */


$('#tableresult').hide();
$('#tableresult-exemplar').hide();
$('#form-exemplar').hide();
$('#form-emprestimo').hide();
$('#btSave').prop('disabled',true);

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
                $('#usuario-user_id').val(data.user_id);
                $('#usuario_idusuario').val(data.idusuario);
                $('#foto-usuario').attr("src",data.foto);
                $('#btSave').prop('disabled',true);
                $('#message-senha-errada').hide();
            }
        });
    }
});


$('#acervoexemplar-codigo_livro').blur(function () {
    var codigoExemplar = $(this).val();
    if (codigoExemplar != ' ' && codigoExemplar.length >0) {


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
                    $('#form-exemplar').show();
                    $('#form-emprestimo').hide();

                } else {
                    $("#message-indisponivel-exemaplar").html("");
                    $('button[type="submit"]').prop('disabled', false);
                    $('#form-exemplar').hide();
                    $('#form-emprestimo').show();
                    $('#btSave').prop('disabled',true);
                }
                $('#btSave').prop('disabled',false);
                $('#w13 li:eq(1)').removeClass();
                $('#w13 li:eq(2)').addClass("active");
                $("#tab-exemplar").removeClass();
                $("#tab-exemplar").addClass("tab-pane fade");
                $("#tab-emprestimo").addClass("tab-pane fade in active");
            } else {
                $('#btSave').prop('disabled',true);
            }

        });
    }else {
        $('#btSave').prop('disabled',true);
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
            if (data != null) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>RG encontrado(s)</b>');
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
                $('#result-messagem-busca-usuario').html('Nenhumo RG encontrado');
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
                $('#result-messagem-busca-usuario').html('</b>RG encontrado(s)</b>');

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
                $('#result-messagem-busca-usuario').html('Nenhumo RG encontrado');
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
                $('#result-messagem-busca-exemplar').html('</b>Exemplares encontrado(s)</b>');
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

$('#user-password').blur(function () {
    var senha = $(this).val();
    var user_id = $('#usuario-user_id').val();
    console.log('user_id.:'+$('#emprestimo-usuario_rg').val().length);
    if (senha != ' ' && senha.length > 0 && $('#emprestimo-usuario_rg').val().length>0) {
        $('#message-senha-errada').hide();

        $.get('validar-senha', {user_id: user_id, senha:senha}, function (data) {
            console.log(data);
            var data = $.parseJSON(data);
            if(data){

                $('#btSave').prop('disabled',false);
                $('#form-usuario').hide();
                $('#form-exemplar').show();
                $('#w13 li:eq(0)').removeClass();
                $('#w13 li:eq(1)').addClass("active");
                $("#tab-usuario").removeClass();
                $("#tab-usuario").addClass("tab-pane fade");
                $("#tab-exemplar").addClass("tab-pane fade in active");
            }else{
                $('#message-senha-errada').attr('class', 'alert alert-danger');
                $('#message-senha-errada').html('<strong>Senha incorreta!</strong>' +
                    'Caso queira alterar a senha,' +
                    ' <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalalterarsenha\">Clique aqui</a>');
                $('#message-senha-errada').show();
                $('#btSave').prop('disabled',true);
                $('#form-usuario').show();
                $('#form-exemplar').hide();

            }
            $('#btSave').prop('disabled',true);
        });
    }else{
        if($('#emprestimo-usuario_rg').val().length <= 0){
            $('#message-senha-errada').attr('class', 'alert alert-danger');
            $('#message-senha-errada').html('<strong>Digite o RG do usuário!</strong>');
        }
    }
});




$('#btAlterarSenha') . click(function () {
    $('#message-resetar-senha').html('');
    $('#message-resetar-senha').removeClass();
        var  novaSenha =  $('#user-newpassword').val();
        var  user_id =  $('#usuario-user_id').val();


    if(user_id.length != ' '  && novaSenha.length >0){


        $.get('../user/admin/resetar-senha',{id : user_id,novaSenha:novaSenha
        }, function (data){

            var data = $.parseJSON(data);
            console.log(data);
            if(data){
                $('#message-resetar-senha').attr('class', 'alert alert-success');
                $('#message-resetar-senha').html('Senha alterada com sucesso');

                $('#user-newpassword').val('');
                $('#user-password').val('');
                $('#message-senha-errada').hide();
            }else{
                $('#message-resetar-senha').attr('class', 'alert alert-danger');
                $('#message-resetar-senha').html('Não foi possível alterar a senha');

            }

        });
    }else{
        alert('Preencha o campo \'RG\'');
    }
});