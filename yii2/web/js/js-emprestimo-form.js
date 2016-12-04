/**
 * Created by aryan on 03/07/16.
 */


var qtdExemplarEmprestimo = 1;

$('#tableresult').hide();

$('#tableresult-exemplar').hide();

$('#btRemoverInputCodigoExemplar').hide();

$('#form-exemplar').hide();

$('#form-emprestimo').hide();

$('#btSave').prop('disabled', true);



var senhaValidada = false;

$('#emprestimo-usuario_rg').blur(function () {
    var
            rg = $(this).val();
    if (rg != ' ') {


        $.get('get-usuario', {rg: rg}, function (data) {

            var
                    data = $.parseJSON(data);
            console.log('get-usuario.: ' + data);
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
                $('#foto-usuario').attr("src", data.foto);
                $('#btSave').prop('disabled', true);
                $('#mensagem-senha-errada').hide();
                $('#result-get-usuario').html('');
                $('#user-password').prop('disabled', false);
                $('#result-get-usuario').hide();
                $('#mensagem-cadastro-usuario').hide();
                $.get('verifica-pode-emprestar', {idusuario: data.idusuario}, function (resultado) {
                    console.log('pode emprestar.:' + resultado);
                    if (resultado == 'false') {

                        $('#user-password').prop('disabled', true);
                        $('#result-get-usuario').attr('class', 'alert alert-danger');
                        $('#result-get-usuario').html('Usuário não tem permissão para realizar empréstimo');

                        $('#result-get-usuario').show();
                    } else {
                        $('#user-password').prop('disabled', false);
                        $('#result-get-usuario').hide();
                    }
                });
            } else {
                $('#result-get-usuario').show();
                $('#result-get-usuario').attr('class', 'alert alert-danger');
                $('#result-get-usuario').html('Usuário não encontrado. Para cadastrar\n\
um novo Usuário, <a href=\"#\" data-toggle=\"modal\"\n\
 data-target=\"#modalcadastrarusuario\">Clique aqui</a>');
                $('#user-password').prop('disabled', true);
            }
        });
    }
});

var exemplarDisponivel = false;

/*$('#acervoexemplar-codigo_livro').blur(function () {
    var codigoExemplar = $(this).val();
    if (codigoExemplar != ' ' && codigoExemplar.length > 0) {


        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {


            var data = $.parseJSON((data));
            console.log('exemplar.: ' + data);
            if (data != null) {
                $("#mensagem-get-acervo-exemplar").hide();
                $('#acervo-titulo').val(data[1].titulo);
                $('#acervo-autor').val(data[1].autor);
                $('#emprestimo-acervo_exemplar_idacervo_exemplar').val(data[0].idacervo_exemplar);
                if (!(data[0].esta_disponivel)) {
                    exemplarDisponivel = false;
                    $("#mensagem-indisponivel-exemplar").html("<div class=\"alert alert-warning\" role=\"alert\">" +
                            "<strong>Alerta!</strong> Exemplar indisponível no momento." +
                            "</div>");
                    $('button[type="submit"]').prop('disabled', true);
                    $('#form-exemplar').show();
                    $('#form-emprestimo').hide();
                    $('#btSave').prop('disabled', true);

                } else {
                    exemplarDisponivel = true;
                    $("#mensagem-indisponivel-exemplar").html("");
                    if ($('#emprestimo-usuario_rg').val().length > 0 &&
                            $('#user-password').val().length > 0) {

                        $('#btSave').prop('disabled', false);
                        $('button[type="submit"]').prop('disabled', false);
                    } else {
                        console.log('usuario_rg.:' + $('#emprestimo-usuario_rg').val().length);

                        $('#btSave').prop('disabled', true);
                        $('button[type="submit"]').prop('disabled', true);
                    }
                    $('#form-exemplar').hide();
                    $('#form-emprestimo').show();


                    $('#w13 li:eq(1)').removeClass();
                    $('#w13 li:eq(2)').addClass("active");
                    $("#tab-exemplar").removeClass();
                    $("#tab-exemplar").addClass("tab-pane fade");
                    $("#tab-emprestimo").addClass("tab-pane fade in active");
                    previsaoDevolucao();

                }

            } else {

                $("#mensagem-get-acervo-exemplar").html("<div class=\"alert alert-danger\" role=\"alert\">" +
                        "<strong>Alerta!</strong> Exemplar não encontrado." +
                        "</div>");
                $("#mensagem-get-acervo-exemplar").show();
                $('#btSave').prop('disabled', true);
            }

        });
    } else {
        $('#btSave').prop('disabled', true);
    }
});*/


var previsaoDevolucao = function () {
    $.get('get-data-previsao-devolucao', function (data) {
        console.log('previsao.: ' + data);
        var data = $.parseJSON((data));

        if (data != null) {

//            $('#mensagem-get-data-previsao').hide();
//            $('#mensagem-get-data-previsao').html('');
            $('#emprestimo-dataprevisaodevolucao').val(data[0]);
            $('#lb-dataprevisaodevolucao').val(data[1]);


        } else {
            $('#btSave').prop('disabled', true);
            $('#mensagem-get-data-previsao').show();
            $('#mensagem-get-data-previsao').html("<div class=\"alert alert-danger\" role=\"alert\">" +
                    "<strong>Alerta!</strong> Configuração de dias de empréstimo ainda não" +
                    " configurada. Para fazer isso,\n\
            <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalconfigurardiasemprestimo\n\
\">Clique aqui</a></div>");
        }


    });
};

$('#busca-usuario').blur(function () {
    var buscausuario = $(this).val();
    console.log('buscausuario.:' + buscausuario.length);
    if (buscausuario != ' ' && buscausuario.length > 0) {


        $.get('get-busca-usuario', {nomeUsuario: buscausuario}, function (data) {

            var data = $.parseJSON(data);
            console.log('get-busca-usuario.: ' + data);
            if (data != null) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-mensagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-mensagem-busca-usuario').html('</b>RG encontrado(s)</b>');
                data.forEach(function (item) {
                    console.log('rg.:' + item.rg);
                    $('#tbody-result').append(
                            '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(\"' + item.rg + '\")\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });

            } else {
                data = null;
                $('#tableresult').hide();
                $('#tbody-result').html('');
                $('#result-mensagem-busca-usuario').attr('class', 'alert alert-danger');
                $('#result-mensagem-busca-usuario').html('Nenhum RG encontrado. Para cadastrar\n\
um novo Usuário, <a href=\"#\" data-toggle=\"modal\"\n\
 data-target=\"#modalcadastrarusuario\">Clique aqui</a>');
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
                $('#result-mensagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-mensagem-busca-usuario').html('</b>RG encontrado(s)</b>');

                data.forEach(function (item) {
                    console.log('rg.:' + item.rg);
                    $('#tbody-result').append(
                            '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(\"' + item.rg + '\")\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });

            } else {
                data = null;
                $('#tableresult').hide();
                $('#tbody-result').html('');
                $('#result-mensagem-busca-usuario').attr('class', 'alert alert-danger');
                $('#result-mensagem-busca-usuario').html('Nenhumo RG encontrado');
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
                $('#result-mensagem-busca-exemplar').attr('class', 'alert alert-success');
                $('#result-mensagem-busca-exemplar').html('</b>Exemplares encontrado(s)</b>');
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
                codigoslivro.forEach(function (item, index) {
                    $('#tbody-result-exemplar').append(
                            '<tr><td>' + titulos[index] + '</td><td>' + autores[index] + '</td><td>' + codigoslivro[index] + '</td><td><a href=\'#\' onclick=\'actionSelecionarExemplar(\"' + codigoslivro[index] + '\")\' class=\'btn btn-success\' id=\'actionbuscarexemplar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });


            } else {
                data = null;
                $('#tableresult-exemplar').hide();
                $('#tbody-result-exemplar').html('');
                $('#result-mensagem-busca-exemplar').attr('class', 'alert alert-danger');
                $('#result-mensagem-busca-exemplar').html('Nenhum exemplar disponível encontrado');
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
                $('#result-mensagem-busca-exemplar').attr('class', 'alert alert-success');
                $('#result-mensagem-busca-exemplar').html('</b>Exemplares encontrados</b>');
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
                codigoslivro.forEach(function (item, index) {
                    $('#tbody-result-exemplar').append(
                            '<tr><td>' + titulos[index] + '</td><td>' + autores[index] + '</td><td>' + codigoslivro[index] + '</td><td><a href=\'#\' onclick=\'actionSelecionarExemplar(\"' + codigoslivro[index] + '\")\' class=\'btn btn-success\' id=\'actionbuscarexemplar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });


            } else {
                data = null;
                $('#tableresult-exemplar').hide();
                $('#tbody-result-exemplar').html('');
                $('#result-mensagem-busca-exemplar').attr('class', 'alert alert-danger');
                $('#result-mensagem-busca-exemplar').html('Nenhum exemplar encontrado');
            }
        });
    }
});

$('#user-password').blur(function () {
    var senha = $(this).val();
    var user_id = $('#usuario-user_id').val();
    console.log('user_id.:' + $('#emprestimo-usuario_rg').val().length);
    if (senha != ' ' && senha.length > 0 && $('#emprestimo-usuario_rg').val().length > 0) {
        $('#mensagem-senha-errada').hide();
        validarSenha(user_id, senha);
    } else {
        if ($('#emprestimo-usuario_rg').val().length <= 0) {
            $('#mensagem-senha-errada').attr('class', 'alert alert-danger');
            $('#mensagem-senha-errada').html('<strong>Digite o RG do usuário!</strong>');
        }
    }
});




$('#btAlterarSenha').click(function () {
    $('#mensagem-resetar-senha').html('');
    $('#mensagem-resetar-senha').removeClass();
    var novaSenha = $('#user-newpassword').val();
    var user_id = $('#usuario-user_id').val();
    var confirmarSenha = $('#user-newpassword-confirm').val();

    if (user_id.length != ' ' && novaSenha.length > 0
            && confirmarSenha.length > 0) {


        if (novaSenha == confirmarSenha) {

            $.get('../user/admin/resetar-senha', {id: user_id, novaSenha: novaSenha
            }, function (data) {

                var data = $.parseJSON(data);
                console.log(data);
                if (data) {
                    $('#mensagem-resetar-senha').attr('class', 'alert alert-success');
                    $('#mensagem-resetar-senha').html('Senha alterada com sucesso');

                    $('#user-newpassword').val('');
                    $('#user-password').val('');
                    $('#user-newpassword-confirm').val('');
                    $('#mensagem-senha-errada').hide();
                    $('#modalalterarsenha').modal('hide');
                } else {
                    $('#mensagem-resetar-senha').attr('class', 'alert alert-danger');
                    $('#mensagem-resetar-senha').html('Não foi possível alterar a senha');

                }

            });
        } else {

            $('#mensagem-resetar-senha').attr('class', 'alert alert-danger');
            $('#mensagem-resetar-senha').html
                    ('Campos Senha e Confirmar Senha não correspondem');

        }
    } else {
        $('#mensagem-resetar-senha').attr('class', 'alert alert-danger');
        $('#mensagem-resetar-senha').html
                ('Preencha o campo Senha e Confirmar Senha');

    }
});


$('#btCadastrarUsuario').click(function () {


    var usuarioPost = new Array();
    var nome = $('#usuario-nome-post').val();
    var rg = $('#usuario-rg-post').val();
    var cpf = $('#usuario-cpf-post').val();
    var telefone = $('#usuario-telefone-post').val();
    var email = $('#usuario-email-post').val();
    var cargo = $('#usuario-cargo-post').val();
    var reparticao = $('#usuario-reparticao-post').val();
    var endereco = $('#usuario-endereco-post').val();
    var situacaousuario = $('#usuario-situacaousuario-post').val();



    var password = $('#user-password-post').val();

    if (nome.length > 0 && rg.length > 0) {


        $.get('../user/admin/create-ajax', {nome: nome, rg: rg,
            cpf: cpf, telefone: telefone, email: email, cargo: cargo,
            reparticao: reparticao, endereco: endereco,
            situacaousuario: situacaousuario,
            password: password

        }, function (data) {
            console.log('bdata: ' + data);
            var data = $.parseJSON(data);
            console.log('adata: ' + data);

            $('#mensagem-cadastro-usuario').show();
            if (data != null && data != false) {
                $('#emprestimo-usuario_rg').val(data[0]);
                $('#usuario-rg-post').val(data[0]);
                $('#emprestimo-usuario_nome').val(data[1]);
                $('#nomeusuario').val(data[1]);
                $('#usuario-cpf').val(data[2]);
                $('#usuario-cargo').val(data[3]);
                $('#usuario-reparticao').val(data[4]);
                $('#emprestimo-usuario_idusuario').val(data[5]);
                $('#usuario_idusuario').val(data[5]);
                $('#usuario-user_id').val(data[6]);
                $('#mensagem-cadastro-usuario').attr('class', 'alert alert-success');
                $('#mensagem-cadastro-usuario').html('Usuário cadastrado com sucesso');
                $('#modalcadastrarusuario').modal('hide');
                $('#result-get-usuario').hide();
                $('#user-password').prop('disabled', false);
                $('#emprestimo-usuario_rg').focus();
            } else {
                $('#mensagem-cadastro-usuario').attr('class', 'alert alert-danger');
                $('#mensagem-cadastro-usuario').html('Não foi possível alterar cadastrar\n\
 usuário');

            }

        });
    } else {
        if (rg.length <= 0) {
            alert('Preencha o campo \'RG\'');
        }
    }
});

/*function isEmail(email) {
 var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 return regex.test(email);
 }*/


$('#btConfigurarDiasEmprestimo').click(function () {

    var diasEmprestimo = $('#config-valor').val();



    if (diasEmprestimo.length != ' ' && diasEmprestimo.length > 0) {


        $.get('configurar-dias-emprestimo', {diasEmprestimo: diasEmprestimo
        }, function (data) {

            var data = $.parseJSON(data);
            console.log(data);
            if (data) {

                $('#mensagem-get-data-previsao').html("<div class=\"alert alert-success\" role=\"alert\">" +
                        "<strong>Sucesso!</strong> Configuração de dias de empréstimo realizado com sucesso. </div>");
                $('#mensagem-get-data-previsao').show();
                $('#modalconfigurardiasemprestimo').modal('hide');
                previsaoDevolucao();

            } else {
                $('#mensagem-get-data-previsao').show();
                $('#mensagem-get-data-previsao').html("<div class=\"alert alert-danger\" role=\"alert\">" +
                        "<strong>Alerta!</strong> Não foi possível fazer a configuração de dias de empréstimo.\n\
     Tente novamente,\n\
            <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalconfigurardiasemprestimo\n\
\">Clicando aqui</a></div>");

            }

        });
    } else {
        alert('Digite a quantidade de dias');
    }
});

$('#confirmar-usuario').click(function () {

    var senha = $('#user-password').val();
    var user_id = $('#usuario-user_id').val();
    validarSenha(user_id, senha);
    console.log('[confirmar-usuario]senhaValidada.: ' + senhaValidada);
    if ($('#emprestimo-usuario_rg').val().length > 0 &&
            $('#user-password').val().length > 0 &&
            senhaValidada) {

        $('#btSave').prop('disabled', false);
        $('#form-usuario').hide();
        $('#form-exemplar').show();
        $('#w13 li:eq(0)').removeClass();
        $('#w13 li:eq(1)').addClass("active");
        $("#tab-usuario").removeClass();
        $("#tab-usuario").addClass("tab-pane fade");
        $("#tab-exemplar").addClass("tab-pane fade in active");
    } else {

        $('#btSave').prop('disabled', true);
        $('button[type="submit"]').prop('disabled', true);
    }

});



$('#confirmar-exemplar').click(function () {

    // var codigoExemplar = $('#acervoexemplar-codigo_livro').val();

    var codigoExemplares = [];
    $("input[name='AcervoExemplar[codigo_livro][]']").each(function() {
       codigoExemplares.push($(this).val());
    });

    // console.log('nu->: '+$("input[name='Acervo[titulo]']").length);



    $.each(codigoExemplares, function(index,codigoExemplar) {
        console.log('s '+(index+1));
/*
 var codigoExemplares = [];

 $("input[name='AcervoExemplar[codigo_livro][]']").each(function() {
 codigoExemplares.push($(this).val());
 });

 console.log($("input[name='Acervo[titulo]']").length);

 $.each(codigoExemplares, function(index,codigoExemplar) {

 });

 var codigoExemplar = $("input[name='AcervoExemplar[codigo_livro][]'").val();

 if(codigoExemplar != '' && codigoExemplar.length > 0){
 $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {
 $('#w10 .row > #acervo-titulo').last().val(data[1].titulo);
 $('#w10 .row > #acervo-autor').last().val(data[1].autor);
 console.log('add-> '+data);
 });
 }
 */

    if (codigoExemplar != ' ' && codigoExemplar.length > 0) {


        $.get('get-exemplar', {codigoExemplar: codigoExemplar}, function (data) {


            var data = $.parseJSON((data));
            console.log('exemplar.: ' + data);
            if (data != null) {
                $("#mensagem-get-acervo-exemplar").hide();
                $("input[name='Acervo[titulo]']:eq("+(index)+")").val(data[1].titulo);
                $("input[name='Acervo[autor]']:eq("+(index)+")").val(data[1].autor);
                $('#emprestimo-acervo_exemplar_idacervo_exemplar').val(data[0].idacervo_exemplar);
                if (!(data[0].esta_disponivel)) {
                    exemplarDisponivel = false;
                    $("#mensagem-indisponivel-exemplar").html("<div class=\"alert alert-warning\" role=\"alert\">" +
                        "<strong>Alerta!</strong> Exemplar indisponível no momento." +
                        "</div>");
                    $('button[type="submit"]').prop('disabled', true);
                    $('#form-exemplar').show();
                    $('#form-emprestimo').hide();
                    $('#btSave').prop('disabled', true);

                } else {
                    exemplarDisponivel = true;
                    $("#mensagem-indisponivel-exemplar").html("");
                    if ($('#emprestimo-usuario_rg').val().length > 0 &&
                        $('#user-password').val().length > 0) {

                        $('#btSave').prop('disabled', false);
                        $('button[type="submit"]').prop('disabled', false);
                    } else {
                        console.log('usuario_rg.:' + $('#emprestimo-usuario_rg').val().length);

                        $('#btSave').prop('disabled', true);
                        $('button[type="submit"]').prop('disabled', true);
                    }
                    $('#form-exemplar').hide();
                    $('#form-emprestimo').show();


                    $('#w13 li:eq(1)').removeClass();
                    $('#w13 li:eq(2)').addClass("active");
                    $("#tab-exemplar").removeClass();
                    $("#tab-exemplar").addClass("tab-pane fade");
                    $("#tab-emprestimo").addClass("tab-pane fade in active");
                    previsaoDevolucao();

                }

            } else {

                $("#mensagem-get-acervo-exemplar").html("<div class=\"alert alert-danger\" role=\"alert\">" +
                    "<strong>Alerta!</strong> Exemplar não encontrado." +
                    "</div>");
                $("#mensagem-get-acervo-exemplar").show();
                $('#btSave').prop('disabled', true);
            }

        });
    } else {
        $('#btSave').prop('disabled', true);
    }
    });

   /* if ($('#emprestimo-usuario_rg').val().length > 0 &&
            $('#user-password').val().length > 0 &&
            $('#acervoexemplar-codigo_livro').val().length > 0 &&
            senhaValidada && exemplarDisponivel) {

        $("#mensagem-indisponivel-exemplar").html("");
        if ($('#emprestimo-usuario_rg').val().length > 0 &&
                $('#user-password').val().length > 0) {

            $('#btSave').prop('disabled', false);
            $('button[type="submit"]').prop('disabled', false);
        } else {
            console.log('usuario_rg.:' + $('#emprestimo-usuario_rg').val().length);

            $('#btSave').prop('disabled', true);
            $('button[type="submit"]').prop('disabled', true);
        }
        $('#form-exemplar').hide();
        $('#form-emprestimo').show();


        $('#w13 li:eq(1)').removeClass();
        $('#w13 li:eq(2)').addClass("active");
        $("#tab-exemplar").removeClass();
        $("#tab-exemplar").addClass("tab-pane fade");
        $("#tab-emprestimo").addClass("tab-pane fade in active");
        previsaoDevolucao();
    } else {

        $('#btSave').prop('disabled', true);
        $('button[type="submit"]').prop('disabled', true);
    }*/

});


function validarSenha(user_id, senha) {
    $.get('validar-senha', {user_id: user_id, senha: senha}, function (data) {
        console.log('val.:' + data);
        var data = $.parseJSON(data);
        if (data) {

            $('#btSave').prop('disabled', false);
            $('#form-usuario').hide();
            $('#form-exemplar').show();
            $('#w13 li:eq(0)').removeClass();
            $('#w13 li:eq(1)').addClass("active");
            $("#tab-usuario").removeClass();
            $("#tab-usuario").addClass("tab-pane fade");
            $("#tab-exemplar").addClass("tab-pane fade in active");
            senhaValidada = true;
        } else {
            $('#mensagem-senha-errada').attr('class', 'alert alert-danger');
            $('#mensagem-senha-errada').html('<strong>Senha incorreta!</strong>' +
                    ' Caso queira alterar a senha,' +
                    ' <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalalterarsenha\">Clique aqui</a>');
            $('#mensagem-senha-errada').show();
            $('#btSave').prop('disabled', true);
            $('#form-usuario').show();
            $('#form-exemplar').hide();
            senhaValidada = false;
        }
        console.log('senhaValidada.: ' + senhaValidada);
        $('#btSave').prop('disabled', true);
    });
}

var inputCodigoExemplar = '<div class="form-group field-inputCodigoExemplar required">'+
'<label class="control-label" for="inputCodigoExemplar">Código Exemplar</label>'+
'<input type="text" id="inputCodigoExemplar" class="form-control" name="AcervoExemplar[codigo_livro][]" placeholder="Digite o código do exemplar">'+
    '<div class="help-block"></div></div>';

function adicionarInputCodigoExemplar() {


       if(qtdExemplarEmprestimo < maxQtdExemplarEmprestimo){
           $("#acervoexemplar-codigo_livro").parent().parent().append(inputCodigoExemplar);

           $("#w10").append($("#w10 .row").last().clone());


            qtdExemplarEmprestimo++;

           $('#btRemoverInputCodigoExemplar').show();
       }else{
           alert('A quantidade máxima de exemplares por empréstimo chegou ao máximo');
       }
    console.log(qtdExemplarEmprestimo);
}

function removerInputCodigoExemplar() {

    if(qtdExemplarEmprestimo > 1) {
        $("input[name='AcervoExemplar[codigo_livro][]']").last().parent().remove();
        $("#w10 .row").last().remove();
        // $("input[name='Acervo[autor]']").last().parent().remove();
        qtdExemplarEmprestimo--;
    }
}